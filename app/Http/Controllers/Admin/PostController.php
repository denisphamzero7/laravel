<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //


    public function index(){
        return '<h1>Danh sách bài viết</h1>';
    }
    public function add(){
        return "<h1>Thêm bài viết</h1>";
    }
    public function edit($id){
        return "Bài viết: ".$id;
    }
    public function update($id){
        return view('admin.posts.update',compact('id'));
    }
    public function delete($id){
        return view('admin.posts.delete',compact('id'));
    }

}
