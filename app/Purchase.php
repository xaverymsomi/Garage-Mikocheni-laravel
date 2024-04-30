<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{

    //
    protected $table = 'tbl_purchases';


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
