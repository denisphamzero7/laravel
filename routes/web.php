<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Mechanics;
use App\Models\Country;
use App\Models\Categories;
use App\Models\Post;
use App\Models\Owners;
use App\Models\Cars;
use App\Models\Users;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\FileIterator\Factory;
use Faker\Factory as FakerFactory;
Route::get('/unicode', function () {
    return view('form');
});
// Route::post('/unicode', function () {
//     return 'Phương thức Post của path/unicode';
// });
// Route::put('/unicode', function () {
//     return 'Phương thức Put của path/unicode';
// });
// Route::delete('/unicode', function () {
//     return 'Phương thức delete của path/unicode';
// });
// Route::patch('/unicode', function () {
//     return 'Phương thức patch của path/unicode';
// });


// Route::match (['get','post','patch','put','delete'],'unicode',function(){
//    return $_SERVER['REQUEST_METHOD'];
// });

// Route::any('/unicode', function (Request $request) {
//    return $request->method();
// });
//route redirect : chuyển hướng


Route::get('/',[HomeController::class,'index'])->name('home');// đặt tên để có thế dễ dàng chuyển hướng
Route::get('/products',[HomeController::class,'getProduct'])->name('product');// đặt tên để có thế dễ dàng chuyển hướng
Route::get('/them-product',[HomeController::class,'getaddProduct'])->name('getadd-product');// đặt tên để có thế dễ dàng chuyển hướng
Route::post('/them-product',[HomeController::class,'addProduct'])->name('add-product');// đặt tên để có thế dễ dàng chuyển hướng
Route::prefix('categories')->group(function(){
    Route::get('/',[CategoriesController::class,'index'])->name('categories.list');
    // hiển thị chi tiết category
    Route::get('/edit/{id}',[CategoriesController::class,'getCategory'])->name('categories.edit');
    Route::put('/update/{id}',[CategoriesController::class,'updateCategory'])->name('categories.update');
    // hiển thị form thêm mới category
    Route::get('/add',[CategoriesController::class,'addcategory'])->name('categories.add');
    // Xử lý thêm mới category
    Route::post('/add',[CategoriesController::class,'hanleAddCategory'])->name('categories.handleAdd');
    // Sử lý file  hiển thị form và sử lí form
    Route::get('/upload',[CategoriesController::class,'getfile'])->name('categories.getfile');
    Route::post('/upload',[CategoriesController::class,'handleFile'])->name('categories.file');
});
// admin route
Route::middleware('auth.admin')->prefix('admin')->group(function(){
        Route::get('/',[Dashboard::class,'index'])->name('admin.dashboard');
        Route::resource('products', ProductController::class)->middleware('product.permission');
});
Route::get('/sanpham/{id}',[HomeController::class,'getDetailProduct'])->name('product.detail');
Route::get('dowload-image',[HomeController::class,'dowloadImage'])->name('dowload-Image');
// Route user
Route::prefix('user')->name('users.')->group(function(){
 Route::get('/',[UserController::class,'index'])->name('index');
 Route::get('/add',[UserController::class,'add'])->name('add');
 Route::post('/add',[UserController::class,'postadd'])->name('postadd');
 Route::get('/edit/{id}',[UserController::class,'getEdit'])->name('edit');
 Route::post('/update',[UserController::class,'postEdit'])->name('postEdit');
 Route::get('/delete/{id}',[UserController::class,'delete'])->name('delete');
  Route::get('/hoc-relation',[UserController::class,'relations'])->name('relations');
});
Route::prefix('posts')->name('posts.')->group(function(){
 Route::get('/',[PostController::class,'index'])->name('index');
 Route::get('/add',[PostController::class,'add'])->name('add');
 Route::get('/edit/{id}',[PostController::class,'update'])->name('update');
 Route::get('/delete/{id}',[PostController::class,'delete'])->name('delete');
 Route::post('/delete-any',[PostController::class,'deleteAny'])->name('delete-any');
});
Route::get('/mechanics',function(){
   $Owner=Mechanics::find(1)->carOwners;
   dd($Owner->name);
});
Route::get('/country',function(){
   $posts=Country::find(2)->posts;
   dd($posts);
});
Route::get('/categories',function(){
   $posts=Categories::find(1)->posts;
   dd($posts);
});
Route::get('/postss',function(){
   $categories=Post::find(6)->categories;
   foreach($categories as $category){
    dd($category->pivot);
   }
});
// Tìm xe của ông chủ
Route::get('/owner',function(){
   $car=Owners::find(1)->car;
dd($car);
});
// tìm Ông chủ của chiếc xe
Route::get('/car',function(){
   $owner=Cars::find(1);
   $owner= $owner->owner;
dd($owner);
});

Route::get('/user1',function(){
  $users = Users::all();
  foreach ($users as $user){
    if(!empty($user->group->name)){
         $groupName =$user->group->name;
    }else{
 $groupName ="Không có ";
    }
    echo  $groupName."<br>";
  }
});
// Route::get('/post', function () {
//     // SỬA: Thêm ->get() vào cuối để lấy dữ liệu
//     $posts = Post::whereHas('comment', function($query){
//         $query->whereNotNull('image');
//     })->get();

//     dd($posts);
// });
// ngược lại tìm các bài post không có comment
// Route::get('/post', function () {
//     // SỬA: Thêm ->get() vào cuối để lấy dữ liệu
//     $posts = Post::doesntHave('comment')->get();
//     dd($posts);
// });
// Route::get('/post', function () {
//     DB::enableQueryLog();
//     // SỬA: Thêm ->get() vào cuối để lấy dữ liệu
//     $posts = Post::whereDoesntHave('comment',function($query){
//         $query->whereNull('image');
//     })->get();
//     // dd(DB::getQuerylog());
//     foreach ($posts as $post){
//         echo $post->id.'<br/>';
//     }
// });
// đếm số lượng post có comment
// Route::get('/post', function () {
//     DB::enableQueryLog();
//     // SỬA: Thêm ->get() vào cuối để lấy dữ liệu
//     $posts = Post::withCount('comment')->get();
//     // dd(DB::getQuerylog());
//     foreach ($posts as $post){
//         dd($post->comment_count);
//     }
// });
// đếm số lược vote cho từng dang sách post
// Route::get('/post', function () {
//     DB::enableQueryLog();
//     // SỬA: Thêm ->get() vào cuối để lấy dữ liệu
//     $posts = Post::withCount(['comment','votes'=>function($query){
//         $query->where('value','>',0);
//     }])->get();
//     // dd(DB::getQuerylog());
//     dd($posts);
//     foreach ($posts as $post){
//         echo $post->votes_count.'<br>';
//     }
// });
// Route::get('/post', function () {
//     DB::enableQueryLog();
//     // SỬA: Thêm ->get() vào cuối để lấy dữ liệu
//     $posts = Post::withCount(['comment','votes as luot_vote'=>function($query){
//         $query->where('value','>',0);
//     }])->get();
//     // dd(DB::getQuerylog());
//     dd($posts);
//     foreach ($posts as $post){
//         echo $post->votes_count.'<br>';
//     }
// });

// lấy danh sách loại thường lazy load
// Route::get('/post',function(){
//     DB::enableQueryLog();
//     $user = Users::all();// lấy tất cả dư liệu
//     foreach($user as $user){
//         if(!empty($user->group)){
//              echo $user->group->name.'<br>';
//         }
//     };
// });


// Lấy dữ liệu 1 lần sử dụng with
// Route::get('/post',function(){
//     DB::enableQueryLog();
//    $users = Users::with('group')->get();
//    foreach ($users as $user){
//     if(!empty($user->group)){
//         echo $user->group->name.'<br>';
//     }
//    };
// });
// thêm ràng buộc đối với phương thức with sử dụng clausure tức là thêm function có điều kiện where
// Route::get('post',function(){
//     DB::enableQueryLog();
//     $users= Users::with(['group'=> function ($query){
//         $query->where('id','>',1);
//     }])->get();
//     foreach ($users as $user){
//     if(!empty($user->group)){
//         echo $user->group->name.'<br>';
//     }
//    };
// });
// lấy dữ liệu 1 lần
// Route::get('/post', function(){
//    DB::enableQueryLog();
//     $users = Users::all();
//     $users->load('group');
//     foreach($users as $user){
//         if(!empty($user->group->name)){
//             echo $user-> group->name.'<br>';
//         }
//     };
//     dd(DB::getQueryLog());
// });
Route::get('/post', function(){
   DB::enableQueryLog();
    $post = Post::find(2);
    $comment = New Comments(
        [
            "name"=>"new name",
            "content"=>" comments"
        ]
        );
    $post = $post->comment()->save($comment);

    dd(DB::getQueryLog());
});

Route::get('/',function(){
    $faker= FakerFactory::create();
    $customers =[];
    for($i=0;$i<10;$i++){
        $customers[$i]=[
            'name'=>$faker->name(),
            'email'=>$faker->unique()->safeEmail(),
            'address'=>$faker->address(),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];
    }
    dd($customers);
})
;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
