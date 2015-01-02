<?php

class Owner extends Eloquent {

	protected $table = 'owners';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function stores() {

		return $this->belongsToMany('Store', 'owner_businesses', 'owner_id', 'business_id');

	}

	public function socialMediaAccounts() {

		return $this->hasMany('SocialMediaAccount', 'owner_id', 'id');
	}

}
