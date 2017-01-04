<?php namespace App\Http\Controllers;

use App\Http\Controllers\APIController as APIController;

class VenueController extends APIController {
	use RestControllerTrait;
	const MODEL = 'App\Models\Venue';
	protected $validationRules = [
		'name' => 'required',
		'category' => 'required',
		'street_address' => 'required',
		'city' => 'required',
		'state' => 'required',
		'zipcode' => 'required',
	];

	public function map() {

		$venues = Venue::all();
		//$items = Item::distance(0.1,'45.05,7.6667')->get();

		dd($venues);

		return view('items.map')->with(['items' => $items]);

	}

}
