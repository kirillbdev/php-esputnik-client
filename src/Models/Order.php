<?php

namespace kirillbdev\PhpEsputnikClient\Models;

class Order extends Model
{
	public static $ORDER_STATUS_INITIALIZED = 'INITIALIZED';
	public static $ORDER_STATUS_ABANDONED_SHOPPING_CART = 'ABANDONED_SHOPPING_CART';

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

	private function isValidKey($key)
	{
		return isset($this->keyMapping[$key]);
	}

	public function toJson()
	{
	}
}