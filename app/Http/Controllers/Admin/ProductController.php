<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function __construct()
    {
        // Middleware xác thực có thể được thêm vào đây nếu cần

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
             $title="Học lập trình laravel 123";
             $content="Nội dung học laravel cơ bản đến nâng cao";
       //compact là 1 hàm giúp tạo mảng từ các biến truyền vào compact('title')
    //  return view('home')->with('title',$title) 1 biến;
    // return view('home')->with(['title'=>$title,'content'=>$content]): truyền nhiều biến
    //  return View::make('home',compact('title','content'));: hiển thị với nhiều biến
    // return view('home')->with(['title'=>$title,'content'=>$content]);
    // $contenview= view('home')->render();
    // dd($contenview);
    // return $contenview;
    }

    /**
     * Show the form for creating a new resource.
     */
    /*
    Hiển thị form thêm sản phẩm (Phương thức GET)
    */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
     /*
    Xử lý thêm sản phẩm (Phương thức POST)
    */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /*
   Lấy ra 1 thông tin của 1 sản phẩm (Phương thức GET)
    */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *      */
     /**
     * HIỂN THỊ FORM (Phương thức GET)
     *      */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // XỬ LÝ CẬP NHẬT (Phương thức PUT/PATCH)
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // XÓA SẢN PHẨM (Phương thức DELETE)
    public function destroy(string $id)
    {
        //
    }
}