<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }
    public function showLoginForm()
    {   if(Auth::guard('doctor')->check()){
          echo "Đăng nhập vào khu vực bác sĩ thành công";
          $doctor = Auth::guard('doctor')->user();
            dd($doctor);
        }
        return view('doctors.auth.login');
    }
    public function login(Request $request)
    {    //except dùng để loại trừ trường _token khỏi dữ liệu đăng nhập
         $datalogin = $request->except('_token');
        //  dd($datalogin);
         if(isDoctorActive($datalogin['email'])){
           // Xử lý logic đăng nhập cho bác sĩ ở đây
           $checkLogin = Auth::guard('doctor')->attempt($datalogin);
           if($checkLogin){
             // Đăng nhập thành công
             return redirect(AppServiceProvider::DOCTOR);
           }
           return redirect()->back()->withErrors(['msg' => 'Email hoặc mật khẩu không đúng.']);

         }else{
           return redirect()->back()->withErrors(['email' => 'Tài khoản bác sĩ không hoạt động hoặc không tồn tại.']);
         }
        // Xử lý logic đăng nhập cho bác sĩ ở đây

    }
}
