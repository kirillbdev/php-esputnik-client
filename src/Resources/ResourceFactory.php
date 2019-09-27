<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

class ResourceFactory
{
	public static function make($name, $client)
	{
		switch ($name) {
			case 'orders':
				return new Orders($client);
			case 'contacts':
				return new Contacts($client);
			case 'event':
				return new Event($client);
		}

		throw new \InvalidArgumentException('Undefined resource name.');
	}
}