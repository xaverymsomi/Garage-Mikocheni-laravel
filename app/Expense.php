<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

	//For 
	protected $table = 'tbl_expenses';

	protected $fillable = ['main_label', 'status', 'date', 'custom_field'];
}
