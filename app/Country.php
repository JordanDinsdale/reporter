<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function dealerships()
    {
        return $this->hasMany(Dealership::class)->orderBy('name');
    }
}
