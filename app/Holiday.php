<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
	//For 
	protected $table = 'tbl_holidays';

	protected $fillable = ['title', 'date', 'description'];
}
