<?php

namespace Alemba\Search;

use System\Classes\PluginBase;
use Backend;
use Event;
use Cms\Classes\Page as CmsPage;
use RainLab\Blog\Models\Post as BlogPost;
use Algolia\AlgoliaSearch\Api\SearchClient;
use Alemba\Search\Models\Settings;
use Alemba\Search\Components\SearchMeta;
use Alemba\Search\Components\SearchSettings;
use Alemba\Search\Components\SearchResults;

class Plugin extends PluginBase
{
    protected $algolia;

    public function pluginDetails()
    {
        return [
            'name' => 'Algolia Search',
            'description' => 'Integrates Algolia search into October CMS.',
            'author' => 'Alemba',
            'icon' => 'icon-search'
        ];
    }

    public function registerComponents()
    {
        return [
            SearchSettings::class => 'searchSettings',
            SearchResults::class => 'searchResults',
            SearchMeta::class => 'searchMeta',
        ];
    }

    public function registerPermissions()
    {
        return [
            'alemba.search.manage_settings' => [
                'tab' => 'Algolia Search',
                'label' => 'Manage Algolia search settings',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Algolia Search Settings',
                'description' => 'Manage Algolia API keys and indexing preferences.',
                'category'    => 'Search',
                'icon'        => 'icon-search',
                'class'       => \Alemba\Search\Models\Settings::class,
                'order'       => 500,
                'keywords'    => 'algolia search settings',
                'permissions' => ['alemba.search.manage_settings']
            ]
        ];
    }

    public function boot()
    {

        // Always extend the BlogPost model and backend form
        \RainLab\Blog\Models\Post::extend(function($model) {
            $model->addFillable(['exclude_from_search', 'search_tags', 'search_priority']);
        });

        \Event::listen('backend.form.extendFields', function($widget) {
            if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) return;
            if (!$widget->model instanceof \RainLab\Blog\Models\Post) return;

            $widget->addFields([
                'exclude_from_search' => [
                    'label'   => 'Exclude from Search',
                    'type'    => 'checkbox',
                    'default' => false,
                    'tab'     => 'Search',
                ],
                'search_tags' => [
                    'label' => 'Search Tags',
                    'type'  => 'text',
                    'tab'   => 'Search',
                    'span'  => 'left',
                    'comment' => 'A comma-delimited list'
                ],
                'search_priority' => [
                    'label' => 'Search Priority',
                    'type'  => 'number',
                    'tab'   => 'Search',
                    'span'  => 'right',
                    'comment' => 'A number from 1-5 (1 being the top priority)'
                ],
            ], 'secondary');
        });

        try {
            $appId = Settings::get('algolia_app_id');
            $apiKey = Settings::get('algolia_api_key');

            if (!$appId || !$apiKey) {
                return;
            }

            $this->algolia = SearchClient::create($appId, $apiKey);

            $this->indexCmsPages();
            $this->indexBlogPosts();
        } catch (\Exception $e) {
            \Log::error('Algolia initialization failed: ' . $e->getMessage());
        }
    }

    protected function indexCmsPages()
    {
        $pages = CmsPage::listInTheme($this->getActiveTheme());

        $records = [];

        foreach ($pages as $page) {
            $components = $page->settings['components'] ?? [];

            if (isset($components['searchMeta']['exclude']) && $components['searchMeta']['exclude']) {
                continue; // skip indexing this page
            }

            $tags = $components['searchMeta']['tags'] ?? '';
            $priority = (int)($components['searchMeta']['priority'] ?? 0);

            $markup = strip_tags($page->markup);
            $content = mb_substr($markup, 0, 300);

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

    protected function indexBlogPosts()
    {
        $collection = BlogPost::isPublished()->where('exclude_from_search', false)->get();

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

    protected function getActiveTheme()
    {
        return \Cms\Classes\Theme::getActiveTheme()->getDirName();
    }
}