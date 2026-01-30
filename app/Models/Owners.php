<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cars;
class Owners extends Model
{
    //
     protected $table='owners';

     public function car(){
        return $this->belongsTo(
        Cars::class,
        'car_id',
        'id'
        );
     }
}