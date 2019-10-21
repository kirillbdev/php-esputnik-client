<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

class Event extends ApiResource
{
	private $params = [];

	public function setParams($params)
	{
		foreach ($params as $key => $value) {
			$this->params[] = [
				'name' => $key,
				'value' => $value
			];
		}

		return $this;
	}

	public function generate($event, $key)
	{
		return $this->client->post('v1/event', [
			'eventTypeKey' => $event,
			'keyValue' => $key,
			'params' => $this->params
		]);
	}
}