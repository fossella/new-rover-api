<?php

class OwnerSession extends Eloquent {

	protected $table = 'owner_sessions';

	public $timestamps = false;

	public function owner() {

		return $this->hasOne('Owner', 'id', 'owner_id');
	}
}