<?php
class AFASintegration {
	private $config;
	private $required = array (
			'dataurl',
			'tokenurl',
			'code',
			'publickey',
			'sessionid' 
	);
	public $data = array (
			'status' => 500,
			'message' => 'An unexpected error occured' 
	);
	public function AFASintegration($request, $config = array()) {
		$this->config = $config;
		$this->data ['timer'] ['start'] = microtime ( true );
		$this->parseRequest ( $request );
		
		$this->data ['timer'] ['end'] = microtime ( true );
		$this->data ['timer'] ['duration'] = $this->data ['timer'] ['end'] - $this->data ['timer'] ['start'];
	}
	public function parseRequest($request) {
		if ($this->checkRequest ( $request ) === false) {
			$this->data ['status'] = 500;
			$this->data ['message'] = 'The parsed request does not contain all required fields';
		}
		if ($request ['publickey'] == $this->config ['public_key']) {
			$this->performPostback ( $request ['tokenurl'], $this->config ['private_key'], $request ['code'] );
		} else {
			$this->data ['status'] = 500;
			$this->data ['message'] = 'The public keys do not match';
		}
	}
	private function performPostback($url, $secret, $code) {
		$curl = curl_init ();
		
		$data = array (
				'secret' => $secret,
				'code' => $code 
		);
		
		curl_setopt ( $curl, CURLOPT_URL, $url );
		curl_setopt ( $curl, CURLOPT_POST, 1 );
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $data ) );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
		
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, $this->config ['validate_ssl'] );
		
		$result = curl_exec ( $curl );
		
		if (curl_errno ( $curl ) !== 0) {
			$this->data ['status'] = 500;
			$this->data ['message'] = 'cURL error (' . curl_errno ( $curl ) . '): ' . curl_error ( $curl );
			return;
		}
		
		$result = json_decode ( $result, true );
		curl_close ( $curl );
		
		if (is_array ( $result )) {
			$this->data ['status'] = 200;
			$this->data ['message'] = 'The postback has been performed and processed without errors';
			$this->data ['data'] = $result;
		} else {
			$this->data ['status'] = 404;
			$this->data ['message'] = 'The data that was returned by the postback does not contain a valid JSON string, possibly because your private key does not match';
		}
	}
	private function checkRequest($request) {
		foreach ( $this->required as $key ) {
			if (isset ( $request [$key] ) === false) {
				return false;
			}
		}
		return true;
	}
}