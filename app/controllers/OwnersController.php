<?php

class OwnersController extends SecureController {

	public function me() {
		$content = array(	'responseCode' => '200',
							'responseStatus' => 'OK',
							'errors' => [],
							'owner' => serialize($this->owner)
						);

		$response = Response::make($content, 200);

		return $response;
	}

}