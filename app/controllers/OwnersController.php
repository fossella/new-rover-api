<?php

class OwnersController extends SecureController {

	public function me() {

		$owner = $this->owner;

		$stores = array();

		foreach ($owner->stores()->get() as $store) {
			array_push($stores, $store->format());
		}

		$facebook = false;

		$twitter = false;

		foreach ($owner->socialMediaAccounts()->get() as $account) {
			if ($account->type == 'facebook') {
				$facebook = $account;
			}

			if ($account->type == 'twitter') {
				$twitter = $account;
			}
		}

		$content = array(	
			'responseCode' => 200,
			'responseStatus' => 'OK',
			'errors' => [],
			'owner' => array(
                'id' => (int) $owner->id,
                'fullname' => $owner->fullname,
                'firstname' => $owner->first_name,
                'lastname' => $owner->last_name,
                'email' => $owner->email,
                'created'=> time($owner->created),
                'opening_flow_status'=>$owner->opening_flow_status,
                'phone' => $owner->phone,
                'title' => $owner->company_title,
                'stores' => $stores,
                'facebook' => $facebook,
                'twitter' => $twitter
                )
		);

		$response = Response::make($content, 200);

		return $response;
	}

	public function receipts() {
		$owner = $this->owner;

		$transactions = array();

		foreach($owner->transactions()->get() as $transaction) {
			array_push($transactions, $transaction->format());
		}

		$content = array(
			'responseCode' => 200,
			'responseStatus' => 'OK',
			'error' => [],
			'transactions' => $transactions,
		);

		$response = Response::make($content, 200);

		return $response;
	}
}