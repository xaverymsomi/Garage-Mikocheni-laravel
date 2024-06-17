<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteObservation extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'tbl_observation';
}
