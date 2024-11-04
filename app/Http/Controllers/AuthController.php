<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Roles;
use App\Models\RolesUser;
use Illuminate\Support\Facades\Auth;


session_start();

class AuthController extends Controller
{
    public function register_auth()
    {
        return view('admin.custom_auth.register');
    }

    public function register(Request $request)
    {
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);

        $admin->save();
        return redirect('/register-auth')->with('message', 'Đăng ký Auth thành công');
    }

    public function validation(Request $request)
    {
        return $this->validate($request, [
            'admin_name' => 'required|max:255',
            'admin_phone' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',
        ]);
    }

    public function login_auth()
    {
        return view('admin.custom_auth.login_auth');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',
        ]);

        // $data = $request->all();
        if (Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])) {
            // echo Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password]);
            return redirect(('/dashboard'));
        }else{
            return redirect('/login-auth')->with('message','Lỗi đăng nhập Auth');
        }
    }

    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth')->with('message','Đăng xuất Auth thành công');

    }
}
