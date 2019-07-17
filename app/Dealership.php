<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealership extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'group_id', 'country_id'
    ];

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class)->withPivot('region_id')->orderBy('name');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class,'dealership_manufacturer');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
