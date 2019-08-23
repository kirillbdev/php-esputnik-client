<?php

namespace kirillbdev\PhpEsputnikClient\Models;

abstract class Model implements \JsonSerializable
{
	protected $data;

	private $validKeys;
	private $formatters;

	abstract protected function validKeys();

	public function __construct()
	{
		$this->validKeys = $this->validKeys();
		$this->formatters = $this->formatters();
	}

	public function __get($name)
	{
		return $this->data[ $name ] ?? null;
	}

	public function __set($name, $value)
	{
		if ($this->isValidKey($name)) {
			$this->data[$name] = $this->formatValue($name, $value);
		}
		else {
			throw new \InvalidArgumentException('Key "' . $name . '" not valid resource key');
		}
	}

	public function jsonSerialize()
	{
		return $this->data;
	}

	protected function formatters()
	{
		return [];
	}

	private function isValidKey($key)
	{
		return in_array($key, $this->validKeys);
	}

	private function formatValue($key, $value)
	{
		if (isset($this->formatters[$key])) {
			return call_user_func($this->formatters[$key], $value);
		}

		return $value;
	}
}