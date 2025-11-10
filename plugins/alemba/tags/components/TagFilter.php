<?php namespace Alemba\Tags\Components;

use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post;
use Alemba\Tags\Models\Tag;
use Alemba\Tags\Models\TagCategory;
use Illuminate\Support\Facades\Input;

/**
 * TagFilter Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class TagFilter extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Tag Filter Component',
            'description' => 'Filters Blog and Success Story articles dynamically'
        ];
    }

    public function defineProperties()
    {
        return [
            'contentType' => [
                'title'       => 'Content Type',
                'description' => 'Specify whether this is for Blog or Success Story',
                'type'        => 'dropdown',
                'default'     => 'blog',
                'options'     => ['blog' => 'Blog', 'success_story' => 'Success Story']
            ],
            'tagCategories' => [
                'title'       => 'Tag Categories',
                'description' => 'Select the tag categories to display',
                'type'        => 'set'
            ]
        ];
    }

    public function getTagCategoriesOptions()
    {
        $categories = TagCategory::orderBy('name')->pluck('name', 'slug')->toArray();
        return $categories ?? [];
    }

   public function onRun()
    {
        $this->page['categories'] = $this->loadCategories();
        $this->page['posts'] = $this->loadPosts();
    }

    // Load categories based on the selected tag categories
    protected function loadCategories()
    {
        $contentType = $this->property('contentType'); // Get the ContentType property

        // Change the relationship depending on the ContentType property
        $tagRelationship = $contentType == 'blog' ? 'posts' : 'successStories';
        
        return TagCategory::with(['tags' => function ($query) use ($tagRelationship) {
            $query->orderBy('name', 'asc')->whereHas($tagRelationship, function($query){
                $query->published();
            });
        }])
        ->when($this->property('tagCategories'), function ($query, $categorySlugs) {
            $query->whereIn('slug', $categorySlugs);
        })
        ->orderBy('name', 'asc')
        ->get();
    }

    // Load all posts with their tag slugs
    protected function loadPosts()
    {
        return Post::with('tags')->get();
    }
}
