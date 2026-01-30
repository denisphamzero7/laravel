<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Users;
class Categories extends Model
{
    //
    protected $table = 'category';
   public function posts (){
        return $this ->belongsToMany(
            Post::class,
            'categories_post',// Bang trung gian
            'categories_id',// cot trung gian
            'post_id'// cot trung gian
        );

    }
}
