<?php namespace App\Http\Controllers;

use App\Http\Controllers\APIController as APIController;

class VenueController extends APIController {
	use RestControllerTrait;
	const MODEL = 'App\Models\Venue';
	protected $validationRules = [
		'name' => 'required',
		'category' => 'required',
		'street_address' => 'required',
		'city_state' => 'required',
		'zipcode' => 'required',
	];

}
