<?php namespace Alemba\FormEmailValidation\Classes;

use App;
use Request;
use GuzzleHttp\Client;

/**
 * Class FormEmailValidationRule
 * @package Alemba\FormEmailValidation
 */
class FormEmailValidationRule
{

    const ENDPOINT = 'https://api.zerobounce.net/v2/';
    const API_KEY = 'e35cb6938659483c8dae05c1375e7f78';

    /**
     * validate determines if the validation rule passes.
     * @param string $attribute
     * @param mixed $value
     * @param array $params
     * @return bool
     */
    public function validate($attribute, $value, $params)
    {

        $validate = true;

        $client = new Client();

        try {

            // Check credits first

            $response = $client->request('GET', self::ENDPOINT.'getcredits', [
                'query' => [
                    'api_key' => self::API_KEY
                ]
            ]);
            $credits = json_decode($response->getBody(), true);

            // If there are zero credits, return true to skip validation

            if($credits['Credits'] == 0) { return true; }

            // Validate e-mail address

            //$emailToValidate = 'disposable@example.com'; // A test address to use without using up API credits
            $emailToValidate = $value;
            $IPToValidate = Request::ip();

            $url = '?api_key='.self::API_KEY.'&email='.urlencode($emailToValidate).'&ip_address='.urlencode($IPToValidate);

            // Send a request

            $response = $client->request('GET', self::ENDPOINT.'validate', [
                'query' => [
                    'api_key' => self::API_KEY,
                    'email' => urlencode($emailToValidate),
                    'ip_address' => urlencode($IPToValidate)
                ]
            ]);

            // Decode the json response

            $response = json_decode($response->getBody(), true);

        } catch(\Exception $exception) {

            $response = false;

        }

        // If there's an issue getting the response, return true (so we don't break the form)

        if(!$response) {
            return true;
        }

        // This is an example of the returned response

        /*

        array (
            'address' => 'disposable@example.com',
            'status' => 'do_not_mail',
            'sub_status' => 'disposable',
            'free_email' => false,
            'did_you_mean' => NULL,
            'account' => NULL,
            'domain' => NULL,
            'domain_age_days' => '9692',
            'smtp_provider' => 'example',
            'mx_found' => 'true',
            'mx_record' => 'mx.example.com',
            'firstname' => 'zero',
            'lastname' => 'bounce',
            'gender' => 'male',
            'country' => NULL,
            'region' => NULL,
            'city' => NULL,
            'zipcode' => NULL,
            'processed_at' => '2023-03-27 11:06:35.191',
        )  
 

        */

        // If it's a free e-mail mailbox, or status is 'do_not_mail', return false

        if($response['free_email'] === true || $response['status'] === 'do_not_mail' || $response['status'] === 'invalid') { 

            $validate = false;

            // Log the e-mail address

            $logMessage = $emailToValidate.' has been blocked from completing a form at '.url()->current();
            \Log::info($logMessage);

        }

        return $validate;
    }

    /**
     * message gets the validation error message.
     * @return string
     */
    public function message()
    {
        return 'Sorry, that e-mail address is not accepted.';
    }
}

?>