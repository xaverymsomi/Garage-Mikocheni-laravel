<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Labours extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'tbl_labours';

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

}
