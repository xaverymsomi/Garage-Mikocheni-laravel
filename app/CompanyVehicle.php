<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use URL;

class CompanyVehicle extends Model
{
    use HasFactory;

    // public function getImageUrls()
    // {
    //     $images = DB::table('tbl_vehicle_images')->where('vehicle_id', $this->id)->get();
    //     $imageUrls = [];
        
    //     if ($images->isNotEmpty()) {
    //         foreach ($images as $image) {
    //             $imageUrls[] = URL::to('/public/companyvehicle/' . $image->image);
    //         }
    //     } else {
    //         $imageUrls[] = URL::to('/public/vehicle/avtar.png');
    //     }
        
    //     return $imageUrls;
    // }

    protected $table = 'tbl_company_vehicles';

}
