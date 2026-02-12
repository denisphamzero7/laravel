<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{   // middleware auth để bảo vệ controller
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $userDetails = Auth::user();

        return view('admin',compact('userDetails'));
    }
}
