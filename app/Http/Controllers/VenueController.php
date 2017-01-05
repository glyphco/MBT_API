<?php
namespace App\Http\Controllers;

use App\Traits\APIResponderTrait;
use App\Traits\RestControllerTrait;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class VenueController extends BaseController {
	use RestControllerTrait;
	use APIResponderTrait;
	use HasRolesAndAbilities;

	const MODEL                = 'App\Models\Venue';
	protected $validationRules = [
		'name'           => 'required',
		'category'       => 'required',
		'street_address' => 'required',
		'city'           => 'required',
		'state'          => 'required',
		'zipcode'        => 'required',
	];

	public function map(Request $request) {
		$location          = $request->input('l', '41.291824,-87.763978');
		$distanceinmeters  = $request->input('d', 100000); //(in meters)
		$distanceindegrees = $distanceinmeters / 111195; //(degrees (approx))

		$m = self::MODEL;
		//$data = $m::pluck('name', 'location');
		$data = $m::distance($distanceindegrees, $location)->get();
		//$data = $m::distance($distanceindegrees, $location)->pluck('name', 'location');

		return $this->listResponse($data);

	}

}
