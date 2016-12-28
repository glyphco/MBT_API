<?php namespace App\Http\Controllers;

use App\Http\Controllers\APIController as APIController;

class ProfileController extends APIController {
	use RestControllerTrait;
	const MODEL = 'App\Models\Profile';
	protected $validationRules = [
		'name' => 'required',
		'category' => 'required',
		'city' => 'required',
		'state' => 'required',
		'zipcode' => 'required',

	];

}
