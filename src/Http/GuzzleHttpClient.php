<?php

namespace kirillbdev\PhpEsputnikClient\Http;

use GuzzleHttp\Client;

class GuzzleHttpClient extends HttpClient
{
	private $guzzle;

	public function __construct($login, $password)
	{
		parent::__construct($login, $password);

		$this->guzzle = new Client();
	}

	public function get($path, $data)
	{
		// TODO: Implement get() method.
	}

	public function post($path, $data)
	{
		$response = $this->guzzle->post($this->apiBaseUrl . $path, [
			'auth' => [
				$this->login,
				$this->password
			],
			'json' => $data
		]);

		return $response->getBody();
	}
}