<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

abstract class Resource
{
	abstract public function getPath($type);
	abstract public function getData();
}