<?php namespace Alemba\Tags;

use Backend;
use System\Classes\PluginBase;
use RainLab\Blog\Controllers\Posts;
use RainLab\Blog\Models\Post;
use Alemba\Tags\Models\Tag;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Tags',
            'description' => 'Adds tag filtering',
            'author' => 'Alemba',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        \Event::listen('backend.form.extendFields', function ($widget) {
            // Ensure this is the Blog Post form
            if (!$widget->getController() instanceof Posts) {
                return;
            }

            // Ensure this is a Blog Post model and it's being updated (not created)
            if ($widget->model instanceof Post && $widget->model->exists) {
                // Add a new "Tags" tab with a relation field
                $widget->addSecondaryTabFields([
                    'tags' => [
                        'label'       => 'Tags',
                        'type'        => 'relation',
                        'relation'    => 'tags',
                        'nameFrom'    => 'name', // Assumes 'name' column in Alemba\Tags\Models\Tag
                        'placeholder' => 'Select tags',
                        'span'        => 'left',
                        'tab'         => 'Tags', // Creates the "Tags" tab
                    ]
                ]);
            }
        });

        \Event::listen('backend.list.extendColumns', function ($widget) {
            if (!$widget->getController() instanceof \RainLab\Blog\Controllers\Posts) {
                return;
            }

            if ($widget->model instanceof \RainLab\Blog\Models\Post) {
                $widget->addColumns([
                    'tags' => [
                        'label' => 'Tags',
                        'type' => 'text',
                        'sortable' => false,
                        'relation' => 'tags',
                        'select' => 'name',
                        'searchable' => true
                    ],
                ]);
            }
        });

        Post::extend(function ($model) {
            $model->morphToMany['tags'] = [
                Tag::class,
                'name' => 'taggable',
                'table'      => 'alemba_tags_tag_taggables', // Custom pivot table
                'foreignKey' => 'taggable_id',
                'otherKey'   => 'tag_id',
            ];

            // Alternatively, if you want a local scope instead of a global scope:
            $model->addDynamicMethod('scopePublished', function ($query) {
                return $query->where('published', 1);
            });

            // Define an accessor for the "resource" attribute which is used on Healthcare etc. pages in the Resources section
            $model->addDynamicMethod('getResourceAttribute', function () use ($model) {
                return [
                    'title' => $model->title_short,
                    'text' => $model->meta_description,
                    'thumbnail' => $model->thumbnail,
                    'url' => $model->canonical_url,
                    'type' => 'article' // This is the button on the card like "Read the article"
                ];
            });
        });
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [
            \Alemba\Tags\Components\TagFilter::class => 'tagFilter',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'alemba.tags.some_permission' => [
                'tab' => 'Tags',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {

        return [
            'tags' => [
                'label' => 'Tags',
                'url' => Backend::url('alemba/tags/tagcategories'),
                'icon' => 'icon-tag',
                'permissions' => ['alemba.tags.*'],
                'order' => 300,

                'sideMenu' => [
                    'tag_categories' => [
                        'label' => 'Categories',
                        'url' => Backend::url('alemba/tags/tagcategories'),
                        'icon' => 'icon-tag',
                        'permissions' => ['alemba.tags.*'],
                        'order' => 301,
                    ],
                    'tags' => [
                        'label' => 'Tags',
                        'url' => Backend::url('alemba/tags/tags'),
                        'icon' => 'icon-tag',
                        'permissions' => ['alemba.tags.*'],
                        'order' => 302,
                    ],
                ]
            ]
        ];
    }
}
