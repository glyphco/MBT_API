<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Profile extends Model
{
    use Userstamps;
    use \App\Traits\SpacialdataTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'slug',
        'category',
        'street_address',
        'city',
        'state',
        'postalcode',
        'lat',
        'lng',
        'phone',
        'location',
        'participant',
        'production',
        'canhavemembers',
        'canbeamember',
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

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'participant', 'profile_id', 'event_id');
    }

}
