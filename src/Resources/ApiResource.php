<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

use kirillbdev\PhpEsputnikClient\Http\HttpClient;

abstract class ApiResource
{
	protected $client;

	public function __construct(HttpClient $client)
	{
		$this->client = $client;
	}
}