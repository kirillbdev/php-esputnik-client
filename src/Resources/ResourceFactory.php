<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

use GuzzleHttp\Exception\InvalidArgumentException;

class ResourceFactory
{
	public static function make($name, $client)
	{
		switch ($name) {
			case 'orders':
				return new Orders($client);
		}

		throw new InvalidArgumentException('Undefined resource name.');
	}
}