<?php

class Discount extends Eloquent {
	protected $table = 'deals';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function stats() {

		return $this->hasMany('DiscountStats', 'deal_id', 'id');
		
	}

	public function shares() {

		return $this->hasMany('Share', 'deal_id', 'id');
	}

	public function stores() {

		return $this->hasMany('Store', 'id', 'business_id');
	}

	public function format() {

		if ($this->stats()->count() != 0) {
			$redeems = $this->stats()->orderBy('created')->first()->pluck('redeems');
			$engagements = $this->stats()->orderBy('created')->first()->pluck('engagements');
		} else {
			$redeems = 0;
			$engagements = 0;
		}

		$store_ids = array();

		foreach($this->stores as $store) {
			array_push($store_ids, $store->id);
		}

		return array(
				'id' => $this->id,
				'name' => $this->desc,
				'description' => $this->desc,
				'fine_print' => $this->fine_print,
				'duration' => array(
						'start' => $this->start,
						'end' => $this->end,
					),
				'template_id' => null, // needs to be implemented
				'redeem_limit' => array(
						'overall_limit' => $this->total_redeem_limit,
						'customer_limit' => $this->user_redeem_limit,
						'customer_range' => null, // needs to be implemented
					),
				'redeems' => array( 
						'total' => $redeems, 
					),
				'engagements' => array(
						'total' => $engagements,
					),
				'shares' => array(
					'total' => $this->shares()->count(),
					),
				'stores' => $store_ids,
				'isActive' => $this->active,
			);
	}
}