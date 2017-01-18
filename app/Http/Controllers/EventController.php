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
		$date    = null;
		$enddate = null;

		if ($request->has('date')) {
			//Date was given, check if ok and add it to the enddate as well
			//see if date is a unix timestamp
			$date = $request->input('date');
			if (!((string) (int) $date === $date) && ($date <= PHP_INT_MAX) && ($date >= ~PHP_INT_MAX)) {
				if (!$date = strtotime($request->input('date'))) {
					return response([
						'error'   => true,
						'message' => 'Invalid Date.',
						'errors'  => 'date cannot be converted properly'],
						400
					);
				}
			}
			//Set Enddate while youre at it
			$startdate = date('Y-m-d' . ' 00:00:00', $date);
			$enddate   = date('Y-m-d' . ' 23:59:59', $date);
			$date      = $startdate;
		}

		if ($request->has('enddate')) {
			if (!$enddate = strtotime($request->input('enddate'))) {
				return response([
					'error'   => true,
					'message' => 'Invalid EndDate.',
					'errors'  => 'end date provided cannot be converted properly'],
					400
				);
			}
			$enddate = date('Y-m-d' . ' 23:59:59', $enddate);
		}

		$m    = self::MODEL;
		$data = $m::with('venue');

		if ($date) {
			$data = $data->InDateRange($date, $enddate);
		}

		if ($request->exists('current')) {
			$data = $data->Current();
		}
		if ($request->has('v')) {
			$data = $data->AtVenue($request->input('v'));
		}
		if ($request->has('vn')) {
			$data = $data->AtVenuename($request->input('vn'));
		}
		if ($request->has('p')) {
			$data = $data->ByParticipant($request->input('p'));
		}
		if ($request->has('pn')) {
			$data = $data->ByParticipantname($request->input('pn'));
		}
		$data = $data->get();

		return $this->listResponse($data);

	}

}
