<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
	//For 
	protected $table = 'tbl_incomes';

	protected $fillable = ['invoice_number', 'payment_number', 'customer_id', 'status', 'payment_type', 'date', 'main_label', 'custom_field'];
}
