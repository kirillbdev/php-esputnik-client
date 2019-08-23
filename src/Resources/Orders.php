<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

class Orders extends ApiResource
{
	public function add($orders)
	{
		if ( ! is_array($orders)) {
			$orderCollection = [ $orders ];
		}
		else {
			$orderCollection = $orders;
		}

		$this->client->post('v1/orders', [
			'orders' => $orderCollection
		]);
	}
}