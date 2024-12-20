<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function insert_coupon()
    {
        return view('admin.coupon.insert_coupon');
    }

    public function list_coupon()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::orderBy('coupon_id', 'DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon','today'));
    }
    public function insert_coupon_code(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $coupon->coupon_condition = $data['coupon_condition'];

        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công');
        return redirect::to('insert-coupon');
    }

    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message', 'Xóa mã giảm giá thành công');
        return redirect::to('list-coupon');
    }

    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            Session::forget('coupon');

            return redirect()->back()->with('message', 'Xóa mã giảm giá thành công');
        }
    }
}

