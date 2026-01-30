<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Owners;
class Cars extends Model
{
   protected $table='cars';
   public function owner()
   {
       return $this->hasOne(
           Owners::class,
           'car_id', // Khóa ngoại trên bảng owners
           'id'      // Khóa chính trên bảng cars
       );
   }
}