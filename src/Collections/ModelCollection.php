<?php

namespace kirillbdev\PhpEsputnikClient\Collections;

use kirillbdev\PhpEsputnikClient\Models\Model;

abstract class ModelCollection
{
	/**
	 * @var Model[]
	 */
	private $models = [];

	public function addModel(Model $model)
	{
		$this->models[] = $model;
	}

	public function getData()
	{
		$data = [];

		foreach ($this->models as $model) {
			$data[] = $model->getData();
		}

		return [
			$this->getName() => $data
		];
	}

	abstract public function getName();
}