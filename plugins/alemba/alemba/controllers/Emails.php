<?php namespace Alemba\Alemba\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

use Request;

use Alemba\Alemba\Models\Email;

class Emails extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'alemba.alemba.' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Alemba.Alemba', 'company', 'emails');
    }

    public function onSendEmail()
    {


    }

    public function send($id)
    {

        // Get the e-mail

        $email = Email::find($id);

        // Loop through the recipients and send an e-mail to each, marking it as sent

        foreach ($email->recipients as $recipient) {

            // Get first name

            $firstname = explode(' ', $recipient->name)[0];

            // Send e-mail

            $vars = ['firstname' => $firstname];

            // Create view from HTML

            $view = new \View($email->body);

            $send = \Mail::send($view, $vars, function($message) use ($email, $recipient) {

                //$message->to($recipient->email, $recipient->name);
                $message->to('andrew.till@alemba.com', $recipient->name);
                $message->from('CloudNotifications@alemba.com', 'Alemba Marketing Team');
                $message->subject($email->name);

            });

            // Mark recipient as sent

            if($send) {

                $recipient->pivot->sent = \Carbon::now();
                $recipient->pivot->save();

            }

        }

        return redirect()->to('/backend/alemba/alemba/emails/update/'.$id);

    }

}
