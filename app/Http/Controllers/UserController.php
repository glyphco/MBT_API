<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use RestControllerTrait;
    const MODEL                = 'App\Models\User';
    protected $validationRules = ['email' => 'required', 'name' => 'required', 'password' => 'required'];
}
