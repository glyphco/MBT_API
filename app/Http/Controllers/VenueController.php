<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class VenueController extends BaseController
{
    use RestControllerTrait;
    const MODEL                = 'App\Models\Venue';
    protected $validationRules = [
        'name'           => 'required',
        'category'       => 'required',
        'street_address' => 'required',
        'city_state'     => 'required',
        'zipcode'        => 'required',
    ];

}
