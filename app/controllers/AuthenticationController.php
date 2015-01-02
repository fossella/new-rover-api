<?php

class AuthenticationController extends BaseController {

	public function authenticate() {

		$email = Input::get('email');
		$password = Input::get('password');

		$count = Owner::where('email', $email)->count();
		$owner = Owner::where('email', $email)->firstOrFail();

		if ($count != 1) {

			App::abort('409', 'Multiple users found with credentials');

		} else {
			if ($owner->password == $password) {
				
				$responseCode = 200;
				$id = $owner->id;

				$content = array(	'responseCode' => 200,
							'responseStatus' => 'OK',
							'errors' => [],
							'authenication' = $this->generateToken($id)
						);

				$response = Response::make($content, $responseCode);

				return $response;
			
			} else {
			
				App::abort('401', 'Bad credentials');
			
			}
		}
	
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