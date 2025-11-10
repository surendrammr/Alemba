<?php
namespace Alemba\Search\Classes;

use Cms\Classes\Theme;
use Cms\Classes\Page as CmsPage;
use RainLab\Blog\Models\Post as BlogPost;
use RainLab\Pages\Classes\Page as StaticPage;
use Alemba\Search\Models\Settings;
use Algolia\AlgoliaSearch\SearchClient;

class SearchIndexer
{
    protected $algolia;

    public function __construct()
    {
        $this->algolia = SearchClient::create(
            Settings::get('algolia_app_id'),
            Settings::get('algolia_api_key')
        );
    }

    public function reindexAll()
    {
        $this->indexCmsPages();
        $this->indexBlogPosts();
    }

    public function indexCmsPages()
    {
        \Log::info('indexing');
        $pages = CmsPage::listInTheme($this->getActiveTheme());

        $records = [];

        foreach ($pages as $page) {
            $components = $page->settings['components'] ?? [];

            if (isset($components['searchMeta']['exclude']) && $components['searchMeta']['exclude']) {
                continue; // skip indexing this page
            }

            $tags = $components['searchMeta']['tags'] ?? '';
            $priority = (int)($components['searchMeta']['priority'] ?? 0);

            $controller = \Cms\Classes\Controller::getController() ?? new \Cms\Classes\Controller();
            $html = $controller->run($page->getBaseFileName(), false);
            $content = strip_tags($html);
            $content = mb_substr($content, 0, 1000); // You can adjust this length

            $records[] = [
                'objectID' => $page->getFileName(),
                'title'    => $page->title,
                'url'      => $page->getBaseFileName(),
                'content'  => $content,
                'tags'     => explode(',', $tags),
                'priority' => $priority,
            ];
        }

        if (!empty($records)) {
            $this->algolia->saveObjects('cms_pages', $records);
        }
    }

    public function indexBlogPosts()
    {
        $collection = BlogPost::isPublished()->get();

        $records = BlogPost::isPublished()->get()->map(function ($post) {
            $content = strip_tags($post->content);
            $excerpt = mb_substr($content, 0, 300);

            return [
                'objectID' => $post->id,
                'title'    => $post->title,
                'summary'  => $post->summary,
                'url'      => '/blog/' . $post->slug,
                'content'  => $excerpt,
            ];
        })->values()->all();

        if (is_array($records) && !empty($records)) {
            $this->algolia->saveObjects('blog_posts', $records);
        }
    }

}