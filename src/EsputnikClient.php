<?php

namespace kirillbdev\PhpEsputnikClient;

use kirillbdev\PhpEsputnikClient\Http\GuzzleHttpClient;
use kirillbdev\PhpEsputnikClient\Resources\ResourceFactory;

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

	public function resource($name)
	{
		if ($this->authenticated()) {
			return ResourceFactory::make($name, $this->httpClient);
		}

		throw new \InvalidArgumentException('Client not authenticated');
	}

	private function authenticated()
	{
		return $this->httpClient !== null;
	}
}