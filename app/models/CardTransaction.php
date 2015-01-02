<?php

class CardTransaction extends Eloquent {
	
	protected $table = 'payment_customer_card_transactions';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function customerCard() {

		return $this->hasOne('CustomerCard', 'processor_card_id', 'payment_processor_card_id');
	}
}