<?php namespace Alemba\BlogExtra;

use Backend;
use System\Classes\PluginBase;
use RainLab\Blog\Models\Post as Post;
use RainLab\Blog\Controllers\Posts as PostsController;

/**
 * BlogExtra Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Ensure RainLab.Blog plugin is added first.
     *
     * @return array
     */
    public $require = ['RainLab.Blog'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'BlogExtra',
            'description' => 'Extends functionality of RainLab Blog plugin',
            'author'      => 'Alemba',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        
        PostsController::extendFormFields(function($form, $model, $context){

            $form->addSecondaryTabFields([
                'title_short' => [
                    'label' => 'Short Title',
                    'commentAbove' => 'This should be a shorter version of the Blog Title that will be used on links',
                    'type' => 'text',
                    'span' => 'full',
                    'tab' => 'Extra',
                ],
                'author' => [
                    'label' => 'Blog post author',
                    'type' => 'text',
                    'span' => 'full',
                    'tab' => 'Extra',
                ],
                'thumbnail' => [
                    'label' => 'Thumbnail',
                    'type' => 'mediafinder',
                    'mode' => 'image',
                    'span' => 'full',
                    'commentAbove' => 'This should be a 250px x 250px image',
                    'tab' => 'Images',
                ],
                'banner' => [
                    'label' => 'Banner',
                    'type' => 'mediafinder',
                    'mode' => 'image',
                    'span' => 'full',
                    'tab' => 'Images',
                ],
                'featured_banner' => [
                    'label' => 'Featured banner image',
                    'type' => 'mediafinder',
                    'mode' => 'image',
                    'span' => 'left',
                    'tab' => 'Featured',
                ],
                'featured_banner_heading' => [
                    'label' => 'Featured banner heading',
                    'commentAbove' => 'Something snappy! This will go on the main Blog page banner',
                    'type' => 'text',
                    'span' => 'right',
                    'tab' => 'Featured',
                ],
            ]);

        });

    }

}
