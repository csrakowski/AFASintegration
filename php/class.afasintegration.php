<?php
/*
 * PHP class AFASintegration
 * This class enables you to integrate your PHP files with the AFAS InSite intranet platform.
 * Please read the online documentation on how to use the PHP class file:
 * https://github.com/alphabase/AFASintegration
 */
class AFASintegration {
	// Configuration variable
	private $config;
	// Required fields in the initial request from the InSite platform
	private $required = array (
			'dataurl',
			'tokenurl',
			'code',
			'publickey',
			'sessionid' 
	);
	// Data variable for returning results
	public $data = array (
			'status' => 500,
			'message' => 'An unexpected error occured' 
	);
	// This function is triggered whenever a new instance of the PHP class is instantiated
	public function AFASintegration($request, $config = array()) {
		// Save the configuration to the local variable
		$this->config = $config;
		// Set the timer for logging the start of the script
		if ($this->config ['debug'] === true) {
			$this->data ['timer'] ['start'] = microtime ( true );
		}
		
		// Parse the request we have received from the InSite platform
		$this->parseRequest ( $request );
		
		// Log the end of running the script and save the performance metrics
		if ($this->config ['debug'] === true) {
			$this->data ['timer'] ['end'] = microtime ( true );
			$this->data ['timer'] ['duration'] = $this->data ['timer'] ['end'] - $this->data ['timer'] ['start'];
		}
	}
	// Handle the request from the InSite platform and perform the postback if the public keys match
	public function parseRequest($request) {
		// If the initial request does not contain all required fields, stop here
		if ($this->checkRequest ( $request ) === false) {
			$this->data ['status'] = 500;
			$this->data ['message'] = 'The parsed request does not contain all required fields';
		}
		// If the public keys match, perform a postback to validate the private keys
		if ($request ['publickey'] == $this->config ['public_key']) {
			$this->performPostback ( $request ['tokenurl'], $this->config ['private_key'], $request ['code'] );
		} else {
			$this->data ['status'] = 500;
			$this->data ['message'] = 'The public keys do not match';
		}
	}
	// Perform a postback with HTTP POST to the InSite platform in order to validate the private key and request session details
	private function performPostback($url, $secret, $code) {
		$curl = curl_init ();
		
		// Prepare the data to send with the postback
		$data = array (
				'secret' => $secret,
				'code' => $code 
		);
		
		// Set url to perform request to
		curl_setopt ( $curl, CURLOPT_URL, $url );
		// Set the request to POST instead of GET
		curl_setopt ( $curl, CURLOPT_POST, 1 );
		// Include the data to send with the request
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $data ) );
		// Request the returning of the data we receive from the postback target
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		// Verify the SSL certificate or not
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, $this->config ['validate_ssl'] );
		
		// Perform the postback
		$result = curl_exec ( $curl );
		
		// If an error occured, include this in the response
		if (curl_errno ( $curl ) !== 0) {
			$this->data ['status'] = 500;
			$this->data ['message'] = 'cURL error (' . curl_errno ( $curl ) . '): ' . curl_error ( $curl );
		} else {
			// Decode the JSON response from the postback
			$result = json_decode ( $result, true );
			// Close the cURL session
			curl_close ( $curl );
			
			// If we have indeed received a valid JSON encoded string, we should have an array now
			if (is_array ( $result )) {
				$this->data ['status'] = 200;
				$this->data ['message'] = 'The postback has been performed and processed without errors';
				$this->data ['data'] = $result;
			} else {
				$this->data ['status'] = 404;
				$this->data ['message'] = 'The data that was returned by the postback does not contain a valid JSON string, possibly because your private key does not match';
			}
		}
	}
	// Validate whether all required fields are included in the request
	private function checkRequest($request) {
		foreach ( $this->required as $key ) {
			if (isset ( $request [$key] ) === false) {
				return false;
			}
		}
		return true;
	}
}