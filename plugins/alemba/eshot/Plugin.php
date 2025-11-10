<?php

namespace Alemba\EShot;

use Backend;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * eShot Plugin Information File
 */
class Plugin extends PluginBase
{
	/**
	 * Returns information about this plugin.
	 *
	 * @return array
	 */
	public function pluginDetails()
	{
		return [
			'name'        => 'e-shot',
			'description' => 'Provides integration with the e-shot newsletter tool.',
			'author'      => 'Moka',
			'icon'        => 'icon-envelope'
		];
	}

	/**
	 * Register method, called when the plugin is first registered.
	 *
	 * @return void
	 */
	public function register()
	{

	}

	/**
	 * Boot method, called right before the request route.
	 *
	 * @return array
	 */
	public function boot()
	{

	}

	/**
	 * Registers any front-end components implemented in this plugin.
	 *
	 * @return array
	 */
	public function registerComponents()
	{
		return []; // Remove this line to activate

		return [
			'Alemba\EShot\Components\MyComponent' => 'myComponent',
		];
	}

	/**
	 * Registers any back-end permissions used by this plugin.
	 *
	 * @return array
	 */
	public function registerPermissions()
	{
		return []; // Remove this line to activate

		return [
			'alemba.eshot.some_permission' => [
				'tab' => 'eShot',
				'label' => 'Some permission'
			],
		];
	}

	/**
	 * Registers back-end navigation items for this plugin.
	 *
	 * @return array
	 */
	public function registerNavigation()
	{
		return []; // Remove this line to activate

		return [
			'eshot' => [
				'label'       => 'eShot',
				'url'         => Backend::url('alemba/eshot/mycontroller'),
				'icon'        => 'icon-envelope',
				'permissions' => ['alemba.eshot.*'],
				'order'       => 500,
			],
		];
	}

	public function registerSettings()
	{
		return [
			'location' => [
				'label'       => 'API configuration',
				'description' => 'Manage API settings',
				'category'    => 'e-shot',
				'icon'        => 'icon-envelope',
                'class'       => 'alemba\eshot\models\Settings',
				'order'       => 500,
				'keywords'    => 'eshot api newsletter'
			]
		];
	}
}
