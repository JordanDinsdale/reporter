<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{

    public function dealerships()
    {
        return $this->belongsToMany(Dealership::class)->withPivot('region_id');
    }

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

}
