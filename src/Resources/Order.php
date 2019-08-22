<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

use GuzzleHttp\Exception\InvalidArgumentException;

class Order extends Resource
{
	public static $ORDER_STATUS_INITIALIZED = 'INITIALIZED';
	public static $ORDER_STATUS_ABANDONED_SHOPPING_CART = 'ABANDONED_SHOPPING_CART';

	private $data;
	private $items = [];

	private $keyMapping = [
		'id' => 'externalOrderId',
		'customer_id' => 'externalCustomerId',
		'total' => 'totalCost',
		'status' => 'status',
		'date' => 'date',
		'email' => 'email' // 2017-05-14T10:11:10.7022176+03:00
	];

	public function __get($name)
	{
		return $this->data[ $name ] ?? null;
	}

	public function __set($name, $value)
	{
		if ($this->isValidKey($name)) {
			$this->data[$name] = $value;
		}
		else {
			throw new InvalidArgumentException('Key "' . $name . '" not valid resource key');
		}
	}

	public function getPath($type)
	{
		if ($type === 'post') {
			return 'v1/orders';
		}

		throw new InvalidArgumentException('Invalid resource path type "' . $type . '"');
	}

	public function getData()
	{
		$result = [];

		foreach ($this->data as $key => $data) {
			$result[ $this->mapKey($key) ] = $this->formatData($key, $data);
		}

		return ['orders' => $result];
	}

	private function isValidKey($key)
	{
		return isset($this->keyMapping[$key]);
	}

	private function mapKey($key)
	{
		return $this->keyMapping[$key] ?? $key;
	}

	private function formatData($key, $data)
	{
		if ($key === 'date') {
			$timestamp = $data->getTimestamp();

			return sprintf(
				'%sT%s',
				date('Y-m-d', $timestamp),
				date('H:i:s.uP', $timestamp)
			);
		}

		return $data;
	}
}