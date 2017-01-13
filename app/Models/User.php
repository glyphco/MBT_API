<?php
namespace App\Models;

use App\Traits\SpacialdataTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;

//use Wildside\Userstamps\Userstamps;

class User extends Model implements
AuthenticatableContract,
AuthenticatableUserContract,
AuthorizableContract {
	use Authenticatable, Authorizable, HasRolesAndAbilities, SpacialdataTrait;
	//use Notifiable;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'avatar', 'slug', 'confirmed', 'is_banned', 'banned_until', 'last_active_desc', 'last_active', 'is_online', 'remember_token',
		'street_address',
		'city',
		'state',
		'zipcode',
		'lat',
		'lng',
		'location',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier() {
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT
	 *
	 * @return array
	 */
	public function getJWTCustomClaims() {
		return [];
	}

}
