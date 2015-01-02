<?php

class AuthenticationController extends BaseController {

	public function authenticate() {

		$email = Input::get('email');
		$password = Input::get('password');

		$count = Owner::where('email', $email)->count();
		$owner = Owner::where('email', $email)->firstOrFail();

		$content = array(	'responseCode' => '',
							'responseStatus' => '',
							'errors' => [],
						);

		if ($count != 1) {

			$responseCode = 409;
			$responseStatus = 'Multiple users found with credentials';

		} else {
			if ($owner->password == $password) {
				
				$responseCode = 200;
				$responseStatus = 'OK';

				$id = $owner->id;
				$authentication = $this->generateToken($id);
			
			} else {
			
				$responseCode = 401;
				$responseStatus = 'Bad credentials';
			
			}
		}

		$content['responseCode'] = $responseCode;
		$content['responseStatus'] = $responseStatus;

		if (isset($authentication)) { $content['authentication'] = $authentication; }

		$response = Response::make($content, $responseCode);

		return $response;
		
	}

	private function generateToken($userID) {

		$uuid = Uuid::generate(4);
		$expiration = time();

		$ownerSession = new OwnerSession;

		$ownerSession->key = $uuid;
		$ownerSession->ip = $_SERVER['REMOTE_ADDR'];
		$ownerSession->created = date("Y-m-d H:i:s");
		$ownerSession->owner_id = $userID;

		$ownerSession->save();

		$token = array(
				'token' => $uuid->__toString(),
				'expiration' => $expiration,
			);

		return $token;

	}
}