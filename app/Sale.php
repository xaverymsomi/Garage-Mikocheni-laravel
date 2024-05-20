<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	//For 
	protected $table = 'tbl_sales';

	protected $fillable = ['customer_id', 'bill_no', 'payment_type_id', 'date', 'vehicle_brand', 'chassisno', 'vehicle_id', 'quantity', 'price', 'total_price', 'salesmanname', 'assigne_to', 'custom_field'];
}
