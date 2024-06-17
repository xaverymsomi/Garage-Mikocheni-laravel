<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
	//For 
	protected $table = 'tbl_points';

	protected $fillable = ['checkout_subpoints', 'vehicle_id', 'checkout_point', 'create_by', 'service_id', 'type'];
}
