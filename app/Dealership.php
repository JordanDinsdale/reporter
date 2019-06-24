<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealership extends Model
{

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class)->withPivot('region_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
