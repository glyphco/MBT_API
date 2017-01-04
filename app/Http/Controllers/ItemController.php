<?php namespace App\Http\Controllers;

use App\Http\Controllers\APIController as APIController;
use App\Models\Item;

class ItemController extends APIController {

	public function map() {

		//$items = Item::all();

		$distanceinmeters = 10000; //(meters)
		$distanceindegrees = $distanceinmeters / 111195; //(degrees (approx))

		$items = Item::distance($distanceindegrees, '45.05,7.6667')->get();

		dd($items->toArray());
//		return view('items.map')->with(['items' => $items]);

	}

}
