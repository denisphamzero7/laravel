<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
class Phone extends Model
{
    //
    protected $table = 'phone';
    protected $fillable = ['phone', 'user_id'];
    // truy vấn ngược
     public function user(){
    return $this->belongsTo(
       Users::class,
        'user_id',// khóa ngoại
        'id'// khóa chính của bản địa phương tức là khóa chính của bảng user là id
    );
  }
}
