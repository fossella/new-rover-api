<?php

class SecureController extends BaseController {

	protected $owner;

	public function __construct() {

		$token = Request::header('Auth-Token');

		$currentOwner = $this->authenticateByToken($token);

		if (!$currentOwner) {

			$content = array(	'responseCode' => '401',
							'responseStatus' => 'Bad token',
							'errors' => [],
						);

			$response = Response::make($content, 401);

			return $response;

		} else {
			$this->owner = $currentOwner;
		}

	}

	private function authenticateByToken($token) {

		$count = OwnerSession::where('key', $token)->count();
		$ownerSession = OwnerSession::where('key', $token)->get();

		if ($count > 1 | $count == 0) {
			return false;
		} else {
			return $ownerSession->user();
		}

	}
}