<?php

namespace kirillbdev\PhpEsputnikClient\Models;

abstract class Model
{
	protected $data;

	private $keyMapping;
	private $formatters;

	abstract public function getData();
	abstract protected function keyMapping();

	public function __construct()
	{
		$this->keyMapping = $this->keyMapping();
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

	protected function formatters()
	{
		return [];
	}

	protected function convertKeyToApiKey($key)
	{
		return $this->keyMapping[$key] ?? $key;
	}

	private function isValidKey($key)
	{
		return isset($this->keyMapping[$key]);
	}

	private function formatValue($key, $value)
	{
		if (isset($this->formatters[$key])) {
			return call_user_func($this->formatters[$key], $value);
		}

		return $value;
	}
}