<?php
namespace App\Http\Controllers;

use App\Traits\APIResponderTrait;
use App\Traits\RestControllerTrait;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class EventController extends BaseController {
	use RestControllerTrait;
	use APIResponderTrait;
	const MODEL                = 'App\Models\Event';
	protected $validationRules = [
		'name'  => 'required',
		'venue' => 'required',
		'start' => 'required',
	];

	public function index(Request $request) {
		$m    = self::MODEL;
		$data = $m::with('venue')->get();

		return $this->listResponse($data);

	}

}
