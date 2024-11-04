<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->input('admin_email');  // Lấy email từ request
        $admin_password = md5($request->input('admin_password'));  // Lấy mật khẩu từ request


        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result) {
            // Đăng nhập thành công
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);

            return redirect('/dashboard'); // Điều hướng đến trang dashboard
        } else {
            // Sai thông tin đăng nhập
            session()->flash('message', 'Mật khẩu hoặc tài khoản bị sai'); // Thông báo lỗi tạm thời

            return redirect('/admin'); // Điều hướng lại trang đăng nhập
        }
    }

    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
