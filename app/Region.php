<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    public function group()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function dealership()
    {
        return $this->belongsTo(Dealership::class);
    }

}
