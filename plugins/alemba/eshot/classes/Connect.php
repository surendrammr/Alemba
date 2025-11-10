<?php namespace Alemba\EShot\Classes;

use App;
use Guzzle\Guzzle;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Alemba\EShot\Models\Settings;

/**
 * Class Connect
 * @package Alemba\EShot
 */
class Connect
{

	protected $baseUri = 'https://rest-api.e-shot.net/';
	protected $endpoint = '';
	protected $apiKey = '';
	protected $subaccountId = '';
	protected $sourceId = '';
	protected $request = '';
	protected $options = [];
	protected $body = [];
	protected $verb = 'GET';	// Default to GET

	public function __construct()
	{

		// Set the API key etc. from the plugin settings

		$this->apiKey = Settings::get('api_key');
		$this->subaccountId = Settings::get('subaccount_id');
		$this->sourceId = Settings::get('source_id');

	}

	public function setEndpoint($endpoint)
	{

		$this->endpoint = $endpoint;

	}

	public function setVerb($verb)
	{

		$this->verb = $verb;

	}

	public function setBody($body = [])
	{

		$this->body = json_encode($body);

	}

	public function setOptions($options = [])
	{

		$this->options = [
			'Content-Type' => 'application/json; charset=utf-8',
			'Authorization' => 'Token '.$this->apiKey
		];

	}

	public function sendRequest()
	{

		// Instantiate the Guzzle client

		$client = new Client([
			'base_uri' => $this->baseUri,
			'timeout'  => 2.0,
		    'verify' => storage_path('app/ssl/cacert.pem'),
		]);

		// Create the request

		$this->setOptions();

		$request = new Request($this->verb, $this->endpoint, $this->options, $this->body);
		
		// Send the request

		$response = $client->send($request);

		return $response;

	}

}

?>