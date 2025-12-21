<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
});
