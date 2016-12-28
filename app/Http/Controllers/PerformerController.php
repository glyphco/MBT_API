<?php namespace App\Http\Controllers;

use App\Http\Controllers\APIController as APIController;

class EventController extends APIController {
	use RestControllerTrait;
	const MODEL = 'App\Models\Event';
	protected $validationRules = [
		'name',
	];

}
