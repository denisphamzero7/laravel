<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{

    public function __construct()
    {
        // Middleware xác thực có thể được thêm vào đây nếu cần
         // Sử dụng session để check nếu admin đã đăng nhập
    }
    public function index()
    {
        return '<h2>Admin Dashboard</h2>';
    }
}