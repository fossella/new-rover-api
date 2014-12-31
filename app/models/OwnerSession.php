<?php

class OwnerSession extends Eloquent {

	protected $table = 'owner_sessions';

	public $timestamps = false;

	public function user() {
	
		return $this->hasOne('User', 'id', 'owner_id');

	}
}