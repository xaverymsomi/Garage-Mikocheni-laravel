<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
	//For 
	protected $table = 'tbl_custom_fields';

	protected $fillable = ['form_name', 'label', 'type', 'required', 'always_visable'];
}
