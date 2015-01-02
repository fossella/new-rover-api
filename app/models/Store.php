<?php

class Store extends Eloquent {
	
	protected $table = 'businesses';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function chain() {

		return $this->hasOne('Chain', 'id', 'chain_id');
	}

	public function owners() {

		return $this->belongsToMany('Owners', 'owners_businesses', 'business_id', 'owner_id');
	}

}