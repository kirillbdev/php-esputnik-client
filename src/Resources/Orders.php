<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

use kirillbdev\PhpEsputnikClient\Collections\OrderCollection;
use kirillbdev\PhpEsputnikClient\Models\Order;

class Orders extends ApiResource
{
	public function add($orders)
	{
		if ($orders instanceof Order) {
			$orderCollection = new OrderCollection();
			$orderCollection->addModel($orders);
		}
		else {
			$orderCollection = $orders;
		}

		$this->client->post('v1/orders', $orderCollection->getData());
	}
}