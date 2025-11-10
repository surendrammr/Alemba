<?php namespace Alemba\UserOptin;

use Backend;
use System\Classes\PluginBase;
use Alemba\Alemba\Models\Subscriber;
use Alemba\Alemba\Models\ListSubscriber;
use Event;
use Carbon\Carbon;

/**
 * UserOptin Plugin Information File
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
            'name'        => 'User Opt-in',
            'description' => 'Update the subscriber preferences',
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

            // If the form is "opt-in"
            
            if($form->code == "opt-in") {

                // Get the user based on their e-mail address

                $subscriber = Subscriber::withTrashed()->where('email', $data['email'])->first();

                // Has the user opted-in or out

                $optin = $data['optin'] == 'YES' ? true : false;

                // If the subscriber exists, update it
                
                if($subscriber) {

                    // Restore if previously deleted

                    $subscriber->restore();

                    // If they're opting-in
                    
                    if($optin) {

                        $subscriber->optin_at = Carbon::now();
                        $result = $subscriber->save();

                    } 

                    // If opting out
                    
                    else {

                        // Delete the user
                        
                        $result = $subscriber->delete();

                        // Delete their linked newsletter subscriptions (important, in case they subscribe again in the future)

                        $delete_lists = ListSubscriber::where('subscriber_id', $subscriber->id)->delete();

                    }

                }

                // Otherwise, add a new record (if they've opted-in)

                else {

                    if($optin) {

                        $array = [
                            'name' => '',
                            'email' => $data['email'],
                            'optin_at' => Carbon::now()
                        ];

                        $result = Subscriber::create($array);

                    }

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
            'Alemba\UserOptin\Components\MyComponent' => 'myComponent',
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
            'alemba.UserOptin.some_permission' => [
                'tab' => 'UserOptin',
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
            'UserOptin' => [
                'label'       => 'UserOptin',
                'url'         => Backend::url('alemba/UserOptin/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['alemba.UserOptin.*'],
                'order'       => 500,
            ],
        ];
    }
}
