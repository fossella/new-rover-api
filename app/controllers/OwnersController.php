<?php

class OwnersController extends SecureController {

	public function me() {

		$owner = $this->owner;

		$stores = $this->formatStores();

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
				                'stores' => $owner->stores()->get(),
				                'facebook' => $facebook,
				                'twitter' => $twitter
				                )
						);

		$response = Response::make($content, 200);

		return $response;
	}

	private function formatStores() {
		$stores = $this->owner->stores()->get();

		$formattedStores = array();

		foreach ($stores as $store) {

			$that = array(	'id' => $store->id,
							'name' => $store->name,
							'website' => $store->website
						)

		}
	}

}