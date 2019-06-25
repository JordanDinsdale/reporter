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

    public function dealerships()
    {
        return $this->belongsToMany(Dealership::class)->withPivot('region_id')->orderBy('name');
    }

    public function regions()
    {
        return $this->hasMany(Region::class)->orderBy('name');
    }

}
