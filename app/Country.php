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

    public function users()
    {
        return $this->hasMany(User::class)->orderBy('surname');
    }

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class,'regions')->withPivot('id','name');
    }

    public function regions()
    {
        return $this->hasMany(Region::class)->orderBy('name');
    }

}
