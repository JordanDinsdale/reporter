<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'surname', 'email', 'password', 'level', 'dealership_id', 'group_id', 'region_id', 'country_id', 'manufacturer_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dealership()
    {
        return $this->belongsTo(Dealership::class)->orderBy('name');
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->orderBy('name');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'sales_executive_id');
    }

}
