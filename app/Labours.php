<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labours extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'tbl_labours';

}
