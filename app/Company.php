<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function manufacturers()
    {
        return $this->hasMany(Manufacturer::class)->orderBy('name');
    }

}
