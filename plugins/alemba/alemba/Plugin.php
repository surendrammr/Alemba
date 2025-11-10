<?php namespace Alemba\Alemba;

use System\Classes\PluginBase;
use RainLab\User\Models\User as UserModel;
use RainLab\User\Controllers\Users as UsersController;
use Alemba\Alemba\Models\Partner as PartnerModel;
use Alemba\Alemba\Models\Form as FormModel;
use Alemba\EShot\Classes\Send as eShot;

class Plugin extends PluginBase
{

    private function separateName($name) {

        $firstname = explode(' ', $name)[0];
        $lastname = str_replace($firstname.' ', '', $name);

        return [$firstname, $lastname];

    }

    private function addToDatabase($form, $data)
    {

        // Loop through fields and add to database 

        $form_code = $form->code;

        // Create an array of database fields and the form data they should contain. It will loop through each and add to the database, if found
        // Any changes here should also be made to console/FormLogsToDB.php

        $form_fields = [
            'name' => ['name'],
            'company' => ['company'],
            'job_title' => ['jobtitle'],
            'email' => ['email'],
            'telephone' => ['telephone'],
            'website' => ['website'],
            'optin' => ['subscribe', 'optin', 'mailing_list', 'newsletter'],
            'address' => ['invoiceaddress'],
            'postcode' => ['postcode'],
            'country' => ['country'],
            'event' => ['event', 'webinar'],
            'notes' => ['diet', 'dietaryrequirement', 'drinks', 'accessrequirement', 'paymentmethod'],
            'referral' => ['referral']
        ];

        // Build an array of data, only adding a field if it exists

        $array = [];
        $array['form'] = $form_code;

        // Generate first and last names automatically

        $name = $this->separateName($data['name']);

        $array['first_name'] = $name[0];
        $array['last_name'] = $name[1];

        // Loop through fields, adding data if available

        foreach ($form_fields as $column_name => $form_data) {

            // $form_data will be an array - loop through to check for existence of field value
            // Future update: the values should be appended to each other so multiple notes can be added

            foreach ($form_data as $value) {

                if(isset($data[$value])) {

                    // If the value is 'Yes', change to 1

                    if($data[$value] == 'Yes') {

                        $column_value = 1;

                    } elseif($data[$value] == 'No') {

                        $column_value = 0;

                    } else {

                        $column_value = $data[$value];

                    }

                    $array[$column_name] = $column_value;

                }

            }

        }
        
        $model = FormModel::create($array);

        return $model;

    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function register()
    {
        $this->registerConsoleCommand('alemba.formlogstodb', 'Alemba\Alemba\Console\FormLogsToDB');
    }

    public function boot()
    {

        // Add the HTTP referrer to the form data

        \Event::listen('formBuilder.extendFormData', function ($data) {
    
            $data['referer'] = request()->header('referer');
            
            return $data;

        });

        // When a form is submitted, add the user to e-shot (if they've opted-in)

        \Event::listen('formBuilder.beforeSendMessage', function ($form, $data) {

            $newGroupIdsArray = [];

            if(isset($data['eshot_group_ids'])) {

                // Get the group IDs from the form, which should be a comma-delimited list

                $groupIdsString = $data['eshot_group_ids'];

                // Turn the group IDs into an array

                $groupIds = explode(',', $groupIdsString);

                // Loop through the group and cast strings to numbers

                $newGroupIdsArray = [];

                foreach ($groupIds as $groupId) {

                    $newGroupIdsArray[] = (int) $groupId;

                }

            }

            // If it's the newsletter form, or if the subscribe checkbox has been ticked, add the contact to the newsletter group

            if( (isset($data['newsletter']) && $data['newsletter'] == 1) || $form->code == "newsletter" || (isset($data['subscribe']) && $data['subscribe'] == 1) ) {

                $newGroupIdsArray[] = 18;

            }

            // Remove duplicated IDs from the array

            $newGroupIdsArray = collect($newGroupIdsArray)->unique()->toArray();

            if(!empty($groupIds)) {

                $eshot = new eShot();
                $eshot->groupIds = $newGroupIdsArray;
                $eshot->saveContact($data);

            }

            // Add the form data to the database

            $this->addToDatabase($form, $data);

        });

    	UserModel::extend(function($model){
    		$model->hasOne['partner'] = ['Alemba\Alemba\Models\Partner', 'order' => 'name asc'];
    	});

    	UsersController::extendFormFields(function($form, $model, $context){
/*
            if(!$model instanceof UserModel) {
                return;
            }

            if(!$model->exists) {
                return;
            }

            // Ensures a partner model always exists

            PartnerModel::getFromUser($model);
*/
    		$form->addFields([

    			'partner' => [
    				'label' => 'Partner',
    				'type' => 'relation',
                    'emptyOption' => 'Select one...'
    			]

    		]);

    	});

    }
}
