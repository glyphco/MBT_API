<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Event extends Model {
	use Userstamps;
	use \App\Traits\SpacialdataTrait;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'venue',
		'street_address',
		'city',
		'state',
		'zipcode',
		'lat',
		'lon',
		'location',
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
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();
		static::addGlobalScope(new \App\Scopes\PublicScope);
		static::addGlobalScope(new \App\Scopes\ConfirmedScope);
		static::addGlobalScope(new \App\Scopes\WithParticipantsScope);
	}

	/**
	 * Get all the Venues for an Event.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function venue() {
		return $this->belongsTo('App\Models\Venue');
	}

	public function participant() {
		return $this->hasMany('App\Models\Participant');
	}

	public function scopePrivate($query) {
		return $query->withoutGlobalScope(PublicScope::class)->where('public', '=', 0);
	}
	public function scopePublicAndPrivate($query) {
		return $query->withoutGlobalScope(PublicScope::class);
	}

	public function scopeUnconfirmed($query) {
		return $query->withoutGlobalScope(ConfirmedScope::class)->where('confirmed', '=', 0);
	}
	public function scopeConfirmedAndUnconfirmed($query) {
		return $query->withoutGlobalScope(ConfirmedScope::class);
	}

	public function scopeNoVenue($query) {
		return $query->withoutGlobalScope(WithVenueScope::class);
	}

	public function scopeNoParticipants($query) {
		return $query->withoutGlobalScope(WithParticipantsScope::class);
	}
}
