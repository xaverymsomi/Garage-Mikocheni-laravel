<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{
    //For 
    protected $table = 'tbl_vehicles';

    protected $guarded = [];


    public function vehicles()
    {
        return $this->hasMany('App\Vehicle', 'customer_id');
    }  
    
    public function scopeGetByUser($query, $id)
    {
        $role = getUsersRole(Auth::User()->role_id);
        if (isAdmin(Auth::User()->role_id)) {
            return $query;
        } else {
            return $query->where('id', Auth::User()->id);
        }
    }
}
