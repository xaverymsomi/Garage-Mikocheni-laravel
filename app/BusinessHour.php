<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
	//For 
	protected $table = 'tbl_business_hours';

	protected $fillable = ['day', 'from', 'to'];
}
