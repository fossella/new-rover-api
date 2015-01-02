<?php

class Chain extends Eloquent {
	
	protected $table = 'chains';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function stores() {

		return $this->hasMany('Stores', 'chain_id', 'id');
	}

}