<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    protected $table ='groups';

     public function users(){
    return $this->hasMany(
       Users::class,
        'group_id',// khóa ngoại
        'id'// khóa chính của bản địa phương tức là khóa chính của bảng user là id
    );}
    public function getAll(){
        $groups= DB::table($this->table)
        ->orderBy('name','ASC')
        ->get();
        return $groups;
    }
}
