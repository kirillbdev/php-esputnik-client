<?php

namespace kirillbdev\PhpEsputnikClient\Models;

use kirillbdev\PhpEsputnikClient\Collections\OrderItemCollection;

/**
 * @property string $externalOrderId
 * @property string $externalCustomerId
 * @property float $totalCost
 * @property string $status
 * @property string $date
 * @property string $email
 * @property string $phone
 * @property string $firstName
 * @property string $lastName
 * @property string $currency
 * @property float $shipping
 * @property float $discount
 * @property float $taxes
 * @property string $restoreUrl
 * @property string $statusDescription
 * @property string $storeId
 * @property string $source
 * @property string $deliveryMethod
 * @property string $paymentMethod
 * @property string $deliveryAddress
 */
class Order extends Model
{
	public static $ORDER_STATUS_INITIALIZED = 'INITIALIZED';
	public static $ORDER_STATUS_ABANDONED_SHOPPING_CART = 'ABANDONED_SHOPPING_CART';

	private $items;

	public function __construct()
	{
		parent::__construct();

		$this->items = new OrderItemCollection();
	}

	public function getData()
	{
		$data = parent::getData();
		$data = array_merge($data, $this->items->getData());

		return $data;
	}

	public function addItem(OrderItem $item)
	{
		$this->items->addModel($item);
	}

	protected function validKeys()
	{
		return [
			'externalOrderId',
			'externalCustomerId',
			'totalCost',
			'status',
			'date',
			'email',
			'phone',
			'firstName',
			'lastName',
			'currency',
			'shipping',
			'discount',
			'taxes',
			'restoreUrl',
			'statusDescription',
			'storeId',
			'source',
			'deliveryMethod',
			'paymentMethod',
			'deliveryAddress'
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