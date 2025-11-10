<?php

namespace Alemba\FormEmailValidation;

use Backend;
use System\Classes\PluginBase;

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
            'name' => 'Form Email Validation Rule Plugin',
            'description' => 'Validates the e-mail address using an API.',
            'author' => 'Alemba',
            'icon' => 'icon-check'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        $this->registerValidationRule('emailvalidation', Classes\FormEmailValidationRule::class);
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Alemba\FormEmailValidationRule\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'alemba.formemailvalidation.some_permission' => [
                'tab' => 'FormEmailValidationRule',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'formemailvalidation' => [
                'label' => 'FormEmailValidationRule',
                'url' => Backend::url('alemba/formemailvalidation/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['alemba.formemailvalidation.*'],
                'order' => 500,
            ],
        ];
    }
}
