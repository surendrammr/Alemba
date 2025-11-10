<?php namespace Alemba\Gartner;

use Backend;
use System\Classes\PluginBase;
use Alemba\Alemba\Models\Subscriber;
use Alemba\Alemba\Models\ListSubscriber;
use Event;
use Carbon\Carbon;

/**
 * Gartner Plugin Information File
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
            'name'        => 'Gartner',
            'description' => 'Add user to the Subscribers table when they submit the form',
            'author'      => 'Alemba',
            'icon'        => 'icon-leaf'
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

        // When a form is submitted, save the user

        \Event::listen('formBuilder.beforeSendMessage', function ($form, $data) {

            // If the form is "gartner-peer-insights"
            
            if($form->code == "gartner-peer-insights") {

                // Get the user based on their e-mail address

                $subscriber = Subscriber::withTrashed()->where('email', $data['email'])->first();

                // Concatanate the name and trim unwanted spaces

                if(isset($data['firstname']) && isset($data['surname'])) {

                    $name = trim($data['firstname']).' '.trim($data['surname']);

                } else {

                    $name = trim($data['name']);

                }

                // Default values

                $company = isset($data['company']) ? $data['company'] : '';
                $jobtitle = isset($data['jobtitle']) ? $data['jobtitle'] : '';
                $telephone = isset($data['telephone']) ? $data['telephone'] : '';
                $optin = '0000-00-00 00:00:00';

                // If the subscriber exists, update the existing record

                if($subscriber) {

                    // Restore if previously deleted

                    $subscriber->restore();

                    $subscriber->name = $name;          // The name may have changed, so update as well so we have the latest info
                    $subscriber->company = $company;
                    $subscriber->jobtitle = $jobtitle;
                    $subscriber->referrer = $form->code;
                    $subscriber->telephone = $telephone;

                    // Has the user opted-in or out

                    if(isset($data['mailing_list']) && $data['mailing_list'] == 1) {

                        $subscriber->optin_at = Carbon::now();

                    }

                    $result = $subscriber->save();

                }

                // Otherwise, create a new subscriber

                else

                {

                    // Create array to save as a new Subscriber

                    $array = [
                        'name' => $name,
                        'email' => $data['email'],
                        'company' => $company,
                        'jobtitle' => $jobtitle,
                        'telephone' => $telephone,
                        'optin_at' => $optin,
                        'referrer' => $form->code
                    ];

                    $new_subscriber = Subscriber::create($array);

                    // Loop through the available lists and add the subscriber to each
/*
                    $lists = ListSubscriber::all();

                    foreach ($lists as $list) {

                        $new_subscriber_list = ListSubscriber::create([
                            'subscriber_id' => $new_subscriber->id,
                            'newsletter_list_id' => $list->id
                        ]);

                    }
*/
                }

            }

        });

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
            'Alemba\Gartner\Components\MyComponent' => 'myComponent',
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
            'alemba.gartner.some_permission' => [
                'tab' => 'Gartner',
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
            'gartner' => [
                'label'       => 'Gartner',
                'url'         => Backend::url('alemba/gartner/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['alemba.gartner.*'],
                'order'       => 500,
            ],
        ];
    }
}
