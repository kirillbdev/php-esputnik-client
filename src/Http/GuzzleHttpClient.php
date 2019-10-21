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
		file_put_contents(base_path('esputnik.request.log'), json_encode($data, JSON_UNESCAPED_UNICODE));

		$response = $this->guzzle->post($this->apiBaseUrl . $path, [
			'auth' => [
				$this->login,
				$this->password
			],
			'json' => $data
		]);

		return [
			'code' => $response->getStatusCode(),
			'body' => $response->getBody()
		];
	}
}