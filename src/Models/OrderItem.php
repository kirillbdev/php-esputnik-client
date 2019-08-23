<?php

namespace kirillbdev\PhpEsputnikClient\Models;

/**
 * @property int $externalItemId
 * @property string $name
 * @property string $category
 * @property int $quantity
 * @property float $cost
 * @property string $url
 * @property string $imageUrl
 * @property string $description
 */
class OrderItem extends Model
{
	protected function validKeys()
	{
		return [
			'externalItemId',
			'name',
			'category',
			'quantity',
			'cost',
			'url',
			'imageUrl',
			'description'
		];
	}
}