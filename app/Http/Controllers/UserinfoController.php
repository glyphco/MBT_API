<?php namespace App\Http\Controllers;

use App\Http\Controllers\APIController as APIController;

class UserinfoController extends APIController {

	public function userinfo() {
		$data = $this->getUser();
		$data['attributes'] = $this->getAttributes();
		return $this->showResponse($data);
	}

	private function getUser() {
		return \Auth::user()->toArray();
	}

	private function getAttributes() {
		return array_pluck(\Auth::user()->getAbilities()->toArray(), 'name');
	}

}
