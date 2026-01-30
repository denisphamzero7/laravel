<?php

namespace App\Models;
use App\Models\Users;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    //
    protected $table = 'categories_post';
    // public function posts (){
    //     return $this ->belongsToMany(
    //         Users::class,
    //         Post::class,
    //         'categories_post',// Bang trung gian
    //         'categories_id',// cot trung gian
    //         'post_id'// cot trung gian
    //     );

    // }
}
