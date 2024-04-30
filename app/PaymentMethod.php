<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
	//For 
	protected $table = 'tbl_payments';

	protected $fillable = ['payment'];
}
