<?php
namespace App\Http\Controllers;

use App\Traits\APIResponderTrait;
use App\Traits\RestControllerTrait;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ProfileController extends BaseController
{
    use RestControllerTrait;
    use APIResponderTrait;
    const MODEL                = 'App\Models\Profile';
    protected $validationRules = [
        'name'       => 'required',
        'category'   => 'required',
        'city'       => 'required',
        'state'      => 'required',
        'postalcode' => 'required',
    ];

    public function index(Request $request)
    {
        $m    = self::MODEL;
        $data = $m::get();

        return $this->listResponse($data);

    }

}
