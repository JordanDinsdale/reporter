<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'colour'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function regions()
    {
        return $this->hasMany(Region::class)->orderBy('name');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class,'regions')->withPivot('id','name');
    }

    public function dealerships()
    {
        return $this->belongsToMany(Dealership::class)->withPivot('region_id')->orderBy('name');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
