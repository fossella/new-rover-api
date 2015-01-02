<?php

class CustomerCard extends Eloquent {
	
	protected $table = 'payment_customer_cards';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';
}