<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Policies\PostPolicy;
class PostController extends Controller
{
    //


    public function index(){
        return '<h1>Danh sách bài viết</h1>';
    }
    public function add(){
        if(Gate::allows('post.add')){
            return "<h1>Thêm bài viết - Được phép</h1>";
        }
        if(Gate::denies('post.add')){
            return "<h1>Thêm bài viết - không Được phép</h1>";
        }
        return "<h1>Thêm bài viết</h1>";
    }
    public function edit($id){
        $post = Post::find($id);

       if( Gate::allows('post.update', $post)){
        return "Bạn được phép sửa bài viết: ".$id;
       };
        if( Gate::denies('post.update', $post)){
            return "Bạn không được phép sửa bài viết: ".$id;
           };
        return "Bài viết: ".$id;
    }
    public function update($id){
        return view('admin.posts.update',compact('id'));
    }
    public function delete($id){
        return view('admin.posts.delete',compact('id'));
    }

}
