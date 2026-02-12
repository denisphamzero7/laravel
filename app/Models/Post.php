<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;
use App\Models\Comments; // ĐÚNG: App viết thường, Models có s
use App\Models\Votes;
class Post extends Model
{   // Sử dụng sortdelete
    // use SoftDeletes;
    // Quy ước đặt tên table
    /*
    Tên Model: Post => table: posts
    Tên Model: ProctCategory: product_categories
    */
    // đặt tên table
    protected $table ='posts';
    //Quy tắt khóa chính, mặc định laravel sẽ lấy field id làm khóa chính
    protected $primaryKey = 'id';
    // Trường hợp khóa chính không để chế độ Auto increment
    public $incrementing = true;
    // Thay đổi kiểu key
    protected $keyType = 'int';
    public $timestamps = true;
    // const CREATED_AT='create_at';
    // const UPDATED_AT='update_at';
    // để giá trị mặt định
     protected $attributes =[
             'status'=>0
    ];
    protected $fillable =['title','content','status'];
    public function categories(){
        return $this->belongsToMany(
           Categories::class,
           'categories_post',// Bang trung gian
           'post_id',// Khóa ngoại trung gian
           'categories_id'// Khóa ngoại trung gian
        )->withPivot('created_at');// Lưu ý đây trường của bảng trung gian
    }
    public function comment() // Tên hàm này phải khớp với tham số trong whereHas('comment')
{

    return $this->hasMany(Comments::class, 'post_id', 'id');
}

   public function votes() // Tên hàm này phải khớp với tham số trong whereHas('comment')
{

    return $this->hasMany(Votes::class, 'post_id', 'id');
}

}
