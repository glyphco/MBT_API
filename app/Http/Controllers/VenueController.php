<?php
namespace App\Http\Controllers;

use App\Traits\APIResponderTrait;
use App\Traits\RestControllerTrait;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class VenueController extends BaseController
{
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
        'postalcode'     => 'required',
        'lat'            => 'required',
        'lng'            => 'required',
    ];

    public function index(Request $request)
    {
        $m = self::MODEL;
        //$data = $m;

        $data = $m::withCount('events')->get();

        return $this->listResponse($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $m = self::MODEL;
        try
        {
            $v = \Illuminate\Support\Facades\Validator::make($request->all(), $this->validationRules);

            if ($v->fails()) {
                throw new \Exception("ValidationException");
            }
            $data = $m::create($request->all());
            return $this->createdResponse($data);
        } catch (\Exception $ex) {
            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
            return $this->clientErrorResponse($data);
        }
    }

    public function destroy($id)
    {
        $m = self::MODEL;
        if (!$data = $m::find($id)) {
            return $this->notFoundResponse();
        }
        $data->delete();
        return $this->deletedResponse();
    }

    public function map(Request $request)
    {
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
