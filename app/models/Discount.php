<?php

class Discount extends Eloquent {
	protected $table = 'deals';

	const CREATED_AT = 'created';
	const UPDATED_AT = 'modified';

	public function format() {
		
	}
}