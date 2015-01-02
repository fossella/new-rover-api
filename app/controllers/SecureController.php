<?php

class SecureController extends BaseController {

	protected $owner;

	public function __construct() {

		$token = Request::header('X-Auth-Token');

		$count = OwnerSession::where('key', $token)->count();

		if ($count > 1 | $count == 0) {

			App::abort('401', 'Bad token');

		} else {
			
			$ownerSession = OwnerSession::where('key', $token)->firstOrFail();

			$this->owner = $ownerSession->owner()->firstOrFail();
		}

	}
}