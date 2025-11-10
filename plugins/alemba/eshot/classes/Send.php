<?php namespace Alemba\EShot\Classes;

use App;
use Guzzle\Guzzle;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Alemba\EShot\Models\Settings;

/**
 * Class Send
 * @package Alemba\EShot
 */
class Send extends Connect
{

	public $firstname = '';
	public $lastname = '';
	public $telephone = '';
	public $company = '';
	public $email = '';
	public $country = ''; // To add?
	public $groupIds = []; // An array of group IDs relating to e-shot groups

	public function saveContact($request = '')
	{

		// Get data from form

		$name_array = explode(' ', $request['name']);
		$this->firstname = $name_array[0];
		$this->lastname = str_replace($this->firstname.' ', '', $request['name']);

		$this->telephone = isset($request['telephone']) ? $request['telephone'] : '';
		$this->company = isset($request['company']) ? $request['company'] : '';
		$this->email = $request['email'];

		// Send the verb and endpoint

		$this->setVerb('POST');
		$this->setEndpoint('Contacts/Save');

		// Build the array of data

		$array = [
			'GroupIDs' => $this->groupIds,
			'SourceID' => $this->sourceId,
			'SubaccountID' => $this->subaccountId,
			'Firstname' => $this->firstname,
			'Lastname' => $this->lastname,
			'Telephone' => $this->telephone,
			'Company' => $this->company,
			'Email' => $this->email,
			'EmailFormat' => 'Html'
		];

		// Set the body

		$this->setBody($array);

		// Send request

		return $this->sendRequest();

	}

}

?>