<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table ='country';
    public function posts(){
        return $this-> hasManyThrough(
            Post::class,// Model muốn liên kết
            Users::class,// model trung gian
            'country_id',// Khóa ngoại trung gian
            'user_id',// KHóa ngoại muốn liên kết
            'id',
            'id'
        );
    }
}
