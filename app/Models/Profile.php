<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Profile extends Model {
	use Userstamps;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'slug',
		'category',
		'street_address',
		'city_state',
		'zipcode',
		'phone',
		'performer',
		'production',
		'hasmembers',
		'canbeamember',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	];
}
