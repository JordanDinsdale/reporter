<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date' , 'end_date' , 'dealership_id' 
    ];

    public function dealership()
    {
        return $this->belongsTo(Dealership::class)->orderBy('name');
    }

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class)->withPivot('data_count','appointments','new','used','zero_km','demo','inprogress');
    }

}
