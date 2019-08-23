<?php

namespace kirillbdev\PhpEsputnikClient\Models;

/**
 * Class Contact
 *
 * @property string $dedupeOn
 * @property string $firstName
 * @property string $lastName
 * @property int $addressBookId
 * @property int $id
 * @property string $contactKey
 * @property string $languageCode
 * @property string $timeZone
 * @property array $contactFields
 */
class Contact extends Model
{
	private $channels = [];

	public function addChannel(ContactChannel $channel)
	{
		$this->channels[] = $channel;
	}

	public function jsonSerialize()
	{
		return array_merge(
			parent::jsonSerialize(),
			[
				'channels' => $this->channels
			]
		);
	}

	protected function validKeys()
	{
		return [
			'firstName',
			'lastName',
			'addressBookId',
			'id',
			'contactKey',
			'languageCode',
			'timeZone',
		];
	}
}