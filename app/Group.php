<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function dealerships()
    {
        return $this->hasMany(Dealership::class);
    }

}
