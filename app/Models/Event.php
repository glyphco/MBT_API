<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Event extends Model {
	use Userstamps;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'venue',
		'venue_info',
		'venue_id',
		'description',
		'start',
		'end',
		'public',
		'confirmed',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	];

	/**
	 * Get all the Venues for an Event.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function venues() {
		return $this->hasMany('App\Models\Venue');
	}

}
