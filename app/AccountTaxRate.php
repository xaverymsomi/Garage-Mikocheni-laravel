<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AccountTaxRate extends Model
{
    //For 
	protected $table = 'tbl_account_tax_rates';

	protected $fillable = ['taxname', 'tax', 'tax_number'];
}
