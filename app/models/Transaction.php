<?php

class Transaction extends Eloquent {
	
	protected $table = 'owner_transactions';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function format() {

		return array(
				'id' => $this->transaction_id,
				'amount' => $this->amount,
				'card' => array(
						'card_holder' => null,
						'masked_numer' => $this->cardTransaction()->customerCard(),
					),
			);

	}

	public function cardTransaction() {

		return $this->hasOne('CardTransaction', 'transaction_id', 'transaction_id'); 
	}

	public function customerCard() {
		return $this->
	}
}