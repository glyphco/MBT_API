<?php
namespace App\Http\Controllers;

use App\Traits\APIResponderTrait;
use Laravel\Lumen\Routing\Controller as BaseController;
use Tymon\JWTAuth\JWTAuth as Auth;

//use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;

class UserinfoController extends BaseController {

	public function __construct(
		Auth $auth) {
		$this->auth = $auth;
	}

	use APIResponderTrait;
	public function userinfo() {
		$data               = $this->getUser();
		$data['attributes'] = $this->getAttributes();
		$data['token']      = app('request')->header('Authorization');
		return $this->showResponse($data);
	}

	private function getUser() {
		return \Auth::user()->toArray();
	}

	private function getAttributes() {
		return array_pluck(\Auth::user()->getAbilities()->toArray(), 'name');
	}

}
