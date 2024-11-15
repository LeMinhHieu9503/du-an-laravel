<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use App\Models\Customer;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgetPassController extends Controller
{
    public function showForm()
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();


        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.forget_pass')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider', $slider)
            ->with('category_post', $category_post);
    }

    // Xử lý quên mật khẩu
    public function resetPassword(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email|exists:tbl_customers,customer_email',
        ]);

        // Tìm khách hàng theo email
        $customer = Customer::where('customer_email', $request->email)->first();

        // Nếu tìm thấy, hiển thị mật khẩu
        if ($customer) {
            return back()->with('message', 'Mật khẩu của bạn là: ' . $customer->customer_password);
        }

        // Nếu không tìm thấy email
        return back()->withErrors(['email' => 'Email không tồn tại']);
    }


    // Change
    public function showChangePasswordForm()
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();


        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.change_password')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider', $slider)
            ->with('category_post', $category_post);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $customer = Auth::user();

        if (!Hash::check($request->current_password, $customer->customer_password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        $customer->customer_password = Hash::make($request->new_password);
        $customer->save();

        return redirect()->route('login')->with('message', 'Đổi mật khẩu thành công, hãy đăng nhập lại');
    }
}
