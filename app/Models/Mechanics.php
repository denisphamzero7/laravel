<?php

namespace App\Models;
use App\Models\{Owners,Cars};
use Illuminate\Database\Eloquent\Model;

class Mechanics extends Model
{
    //
     protected $table='mechanics';
     public function carOwners()
     {
        return $this->hasOneThrough(
            Owners::class,// Model muốn liên kết tới
            Cars::class,// Model trung gian
            'mechanic_id',// Khóa ngoại của table trung gian (car)
            'car_id',// Khóa ngoại của table liên kết tới (Owners)
            'id',// Khóa chính của table hiện tại (mechanic)
            'id'// Khóa chính của car
        );
     }
}