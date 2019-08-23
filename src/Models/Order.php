<?php

namespace kirillbdev\PhpEsputnikClient\Models;

class Order extends Model
{
	public static $ORDER_STATUS_INITIALIZED = 'INITIALIZED';
	public static $ORDER_STATUS_ABANDONED_SHOPPING_CART = 'ABANDONED_SHOPPING_CART';

	private $items = [];

	public function getData()
	{
		$data = [];

		foreach ($this->data as $key => $value) {
			$data[$this->convertKeyToApiKey($key)] = $value;
		}

		$data['items'] = $this->items;

		return $data;
	}

	protected function keyMapping()
	{
		return [
			'id'            => 'externalOrderId',
			'customer_id'   => 'externalCustomerId',
			'total'         => 'totalCost',
			'status'        => 'status',
			'date'          => 'date',
			'email'         => 'email'
		];
	}

	protected function formatters()
	{
		return [
			'date' => [ $this, 'formatDate' ]
		];
	}

	/**
	 * @param \DateTime $datetime
	 *
	 * @return string
	 */
	public function formatDate($datetime)
	{
		$timestamp = $datetime->getTimestamp();

		return sprintf(
			'%sT%s',
			date('Y-m-d', $timestamp),
			date('H:i:s.uP', $timestamp)
		);
	}
}