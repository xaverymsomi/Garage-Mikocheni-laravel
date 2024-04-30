<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Updatekey extends Model
{
    //For 
	protected $table = 'updatekey';

	protected $fillable = ['stripe_id','secret_key','publish_key'];
}
