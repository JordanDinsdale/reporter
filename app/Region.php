<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country_id', 'manufacturer_id'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
