<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Traits\APIResponderTrait;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ItemController extends BaseController {

	use APIResponderTrait;

	public function map(Request $request) {

		//$items = Item::all();

		$distanceinmeters  = $request->input('d', 10000); //(in meters)
		$distanceindegrees = $distanceinmeters / 111195; //(degrees (approx))

		$items = Item::distance($distanceindegrees, '45.05,7.6667')->get();

		dd($items->toArray());
//		return view('items.map')->with(['items' => $items]);

	}

}
