<?php
namespace App\Models;

use App\Traits\SpacialdataTrait;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Venue extends Model {
	use Userstamps;
	use SpacialdataTrait;
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
		'city',
		'state',
		'zipcode',
		'lat',
		'lng',
		'phone',
		'email',
		'location',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	];

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();
		static::addGlobalScope(new \App\Scopes\PublicScope);
		static::addGlobalScope(new \App\Scopes\ConfirmedScope);
	}
}
