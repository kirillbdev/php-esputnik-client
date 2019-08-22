<?php

namespace kirillbdev\PhpEsputnikClient;

use GuzzleHttp\Exception\InvalidArgumentException;
use kirillbdev\PhpEsputnikClient\Http\GuzzleHttpClient;
use kirillbdev\PhpEsputnikClient\Resources\Resource;

class EsputnikClient
{
	/**
	 * @var \kirillbdev\PhpEsputnikClient\Http\HttpClient
	 */
	private $httpClient;

	public function authenticate($login, $password)
	{
		$this->httpClient = new GuzzleHttpClient($login, $password);
	}

	public function send(Resource $resource)
	{
		if ($this->authenticated()) {
			$this->httpClient->post($resource->getPath('post'), $resource->getData());
		}
	}

	private function authenticated()
	{
		if ( ! $this->httpClient) {
			throw new InvalidArgumentException('Client not authenticated');
		}

		return true;
	}
}