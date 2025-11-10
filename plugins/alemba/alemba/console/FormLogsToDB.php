<?php namespace Alemba\Alemba\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Renatio\FormBuilder\Models\FormLog;
use Alemba\Alemba\Models\Form;
use RainLab\Location\Models\Country;

class FormLogsToDB extends Command
{
	/**
	 * @var string The console command name.
	 */
	protected $name = 'alemba:formlogstodb';

	/**
	 * @var string The console command description.
	 */
	protected $description = 'Write form logs to Form model';

	private function separateName($name) {

		$firstname = explode(' ', $name)[0];
		$lastname = str_replace($firstname.' ', '', $name);

		return [$firstname, $lastname];

	}

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function handle()
	{

		// Get all form logs

		$logs = FormLog::all();

		// Loop through log entries

		foreach ($logs as $entry) {

			// Blank array to store form data to be written as a new Form model

			$array = [];

			// Get form data

			$data = $entry->form_data;

			// Add form name, created_at

			$array['form'] = $entry->form->code;
			$array['created_at'] = $entry->created_at;

			foreach ($data as $key => $value) {

				// Array of keys and columns for the Form table
				// This is taken from Plugin.php

				$form_fields = collect([
					'name' => ['name'],
					'company' => ['company'],
					'job_title' => ['jobtitle'],
					'email' => ['email'],
					'telephone' => ['telephone'],
					'website' => ['website'],
					'optin' => ['subscribe', 'optin', 'mailing_list', 'newsletter'],
					'address' => ['address', 'invoiceaddress'],
					'postcode' => ['postcode'],
					'country' => ['country'],
					'event' => ['event', 'webinar'],
					'notes' => ['diet', 'dietaryrequirement', 'drinks', 'accessrequirement', 'paymentmethod'],
					'referral' => ['referral']
				]);

				// Allowed columns

				$columns_allowed = $form_fields->values()->flatten()->toArray();

				// If the key is one of the columns for the form table, add it to the array

				if(in_array($key, $columns_allowed)) {

					// Get the column name from the value

					foreach ($form_fields as $actual_column_name => $allowed_column_names) {

						// If the allowed column name is a match, get the key ($actual_column_name)

						if(in_array($key, $allowed_column_names)) {

							// If the value is 'YES', change to 1

							if($value['value'] == 'YES') {

								$column_value = 1;

							} elseif($value['value'] == 'NO') {

								$column_value = 0;

							} else {

								$column_value = $value['value'];

							}

							// Add to the array

							$array[$actual_column_name] = $column_value;

							// Generate first and last names automatically

							if($key == 'name') {

								$name = $this->separateName($value['value']);

								$array['first_name'] = $name[0];
								$array['last_name'] = $name[1];

							}

							// Get country name from the country ID

							if($key == 'country') {

								$country = Country::find($value['value']);

								$array['country'] = $country ? $country->name : null;

							}

							break;

						}

					}

				}

			}

			// If it's a test entry, don't add it

			if((isset($array['name']) && in_array($array['name'], ['test', 'Martin Smith', 'Elzette Wilkinson', 'Andrew Till', 'Joe Bloggs']) || isset($array['email']) && in_array($array['email'], ['alemba.com', 'alembagroup.com', 'tillathenun@mac.com'])) || (isset($array['company'] ) && $array['company'] == 'Alemba') ) {

				// Do nothing

			} else {

				// Write status to the console

				$email = isset($array['email']) ? $array['email'] : '';

				$description = [$array['form'], (isset($array['name']) ? $array['name'] : ''), $email, $array['created_at']->format('d M Y')];

				$this->output->writeln('Added: '.implode(', ', $description) );

				// Create (or update, matching e-mail address and timestamp) a form model

				Form::updateOrCreate(['email' => $email, 'created_at' => $array['created_at']], $array);

			}

		}


	}

	/**
	 * Get the console command arguments.
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}
}
