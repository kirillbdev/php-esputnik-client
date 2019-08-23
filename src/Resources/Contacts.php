<?php

namespace kirillbdev\PhpEsputnikClient\Resources;

class Contacts extends ApiResource
{
	public static $DEDUPE_EMAIL = 'email';
	public static $DEDUPE_SMS = 'sms';
	public static $DEDUPE_PUSH = 'push';
	public static $DEDUPE_WEB_PUSH = 'webpush';

	private $dedupeOn;
	private $contactFields = [];
	private $groups = [];
	private $newContactEvent;

	// todo: Дописать остальные константы уникальности

	public function add($contacts)
	{
		if ( ! is_array($contacts)) {
			$contacts = [ $contacts ];
		}

		$this->client->post('v1/contacts', $this->compareData($contacts));
	}

	public function setDedupeOn($dedupeOn)
	{
		$this->dedupeOn = $dedupeOn;

		return $this;
	}

	public function setContactFields($fields)
	{
		$this->contactFields = $fields;

		return $this;
	}

	public function setGroups($groups)
	{
		$this->groups = $groups;

		return $this;
	}

	public function setNewContactEvent($event)
	{
		$this->newContactEvent = $event;

		return $this;
	}

	private function compareData($contacts)
	{
		$data['dedupeOn'] = $this->dedupeOn;
		$data['contactFields'] = $this->contactFields;
		$data['contacts'] = $contacts;
		$data['groupNames'] = $this->groups;

		if (isset($this->newContactEvent)) {
			$data['eventKeyForNewContacts'] = $this->newContactEvent;
		}

		return $data;
	}
}