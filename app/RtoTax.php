<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtoTax extends Model
{
	//For 
	protected $table = 'tbl_rto_taxes';

	protected $fillable = ['vehicle_id', 'registration_tax', 'number_plate_charge', 'muncipal_road_tax', 'custom_field'];
}
