<?php
namespace App\Http\Controllers;

use App\Traits\APIResponderTrait;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserinfoController extends BaseController {

	use APIResponderTrait;
	public function userinfo() {
		$data               = $this->getUser();
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
