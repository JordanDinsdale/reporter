<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'surname', 'sale', 'sales_executive_id', 'manufacturer_id', 'region_id', 'created_by_id'
    ];

    public function sales_executive()
    {
        return $this->belongsTo(User::class, 'sales_executive_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
