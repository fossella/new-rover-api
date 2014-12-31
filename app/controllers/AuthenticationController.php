<?php

class AuthenticationController extends BaseController {

	public function authenticate() {

		$email = Input::get('email');
		$password = Input::get('password');

		if (Auth::attempt(array('email' => $email, 'password' => $password))) {
			$responseCode = 200;
			$content = $this->generateToken(Auth::id());

		} else {
			$responseCode = 401;
			if ($email == "") {
				$content = 'Bad credentials';
			}
		}

		$response = Response::make("banana", $responseCode);

		return $response;
	}

	private function generateToken($userID) {

		$uuid = Uuid::generate(4);
		$expiration = time();

		$ownerSession = new OwnerSession;

		$ownerSession->key = $uuid;
		$ownerSession->ip = $_SERVER['REMOTE_ADDR'];
		$ownerSession->created = $expiration;
		$ownerSession->owner_id = $userID;

		$ownerSession->save();

		$token = array(
				'token' => $uuid,
				'expiration' => $expiration,
			);

		return $token;

	}

	public function authenticateByToken() {

		$token = Request::header('Auth-Token');

		$ownerSession = OwnerSession::where('key', $token)->get();

		if ($ownerSession->count > 1 | $ownerSession->count == 0) {
			return false;
		} else {
			return true;
		}

	}
}