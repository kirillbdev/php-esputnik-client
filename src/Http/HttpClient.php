<?php

namespace kirillbdev\PhpEsputnikClient\Http;

abstract class HttpClient
{
	protected $apiBaseUrl = 'https://esputnik.com/api/';
	protected $login;
	protected $password;

	public function __construct($login, $password)
	{
		$this->login = $login;
		$this->password = $password;
	}

	abstract public function get($path, $data);
	abstract public function post($path, $data);
}