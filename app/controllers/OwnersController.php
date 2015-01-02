<?php

class OwnersController extends SecureController {

	public function me() {

		$owner = $this->owner;

		$stores = array();

		foreach ($owner->stores()->get() as $store) {
			array_push($stores, $store->format());
		}

		$facebook = array();

		$twitter = array();

		$content = array(	'responseCode' => '200',
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
}