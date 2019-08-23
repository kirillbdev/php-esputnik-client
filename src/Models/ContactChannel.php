<?php

namespace kirillbdev\PhpEsputnikClient\Models;

/**
 * Class ContactChannel
 *
 * @property string $type
 * @property string $value
 */
class ContactChannel extends Model
{
	public static $TYPE_EMAIL = 'email';
	public static $TYPE_SMS = 'sms';
	public static $TYPE_MOBILE_PUSH = 'mobilepush';
	public static $TYPE_WEB_PUSH = 'webpush';

	public static function makeEmailChannel($email)
	{
		$channel = new self();
		$channel->type = self::$TYPE_EMAIL;
		$channel->value = $email;

		return $channel;
	}

	protected function validKeys()
	{
		return [
			'type',
			'value'
		];
	}
}