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

	public function coordinates() {
		return $this->belongsTo('Coordinates', 'id', 'business_id');
	}

	public function beacons() {

		return $this->hasMany('Beacon', 'business_id', 'id');

	}

	public function discounts() {

		return $this->belongsToMany('Discount', 'business_deals', 'business_id', 'deal_id');

	}

	public function format() {

		$discounts = array();

		foreach ($this->discounts()->get() as $discount) {
			array_push($discounts, $discount->format());
		}

		return array(
				'id' => $this->id,
				'name' => $this->name,
				'phone' => $this->phone,
				'website' => $this->website,
				'description' =>  $this->description,
				'image' => $this->image,
				'location' => array(
						'address' => $this->address,
						'city' => $this->city,
						'state' => $this->state,
						'zip' => $this->zip,
						'latitude' => $this->coordinates()->pluck('lat'),
						'longitude' => $this->coordinates()->pluck('lon'),
					),
				'chain' => array(
						'id' => $this->chain()->pluck('id'),
						'name' => $this->chain()->pluck('name'),
						'image' => 'http://softlaunch.roverlink.com/images/assets/businesslogo.jpg',
					),
				'beacons' => $this->beacons()->get(),
				'discount' => $discounts,
			);
	}

}