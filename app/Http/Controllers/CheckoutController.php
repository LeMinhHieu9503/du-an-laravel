<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

session_start();

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout()
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();

        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.login_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_post', $category_post)
            ->with('slider', $slider);
    }

    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }

    public function checkout()
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();
        // Lấy ID khách hàng từ session
        $customer_id = Session::get('customer_id');

        // Tìm khách hàng dựa theo ID
        $customer = Customer::find($customer_id);
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        $city = City::orderBy('matp', 'ASC')->get();
        $coupons = Coupon::all();


        return view('pages.checkout.show_checkout')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('category_post', $category_post)
            ->with('city', $city)
            ->with('coupons', $coupons)
            ->with('slider', $slider)
            ->with('customer',$customer);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    }
    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        return view('pages.checkout.payment')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);
    }

    public function order_place(Request $request)
    {
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            // Thanh toán bằng thẻ ATM
            Cart::destroy();
        } elseif ($data['payment_method'] == 2) {
            // Thanh toán bằng tiền mặt
            Cart::destroy();

            $cate_product = DB::table('tbl_category_product')
                ->where('category_status', '0')
                ->orderby('category_id', 'desc')
                ->get();
            $brand_product = DB::table('tbl_brand')
                ->where('brand_status', '0')
                ->orderby('brand_id', 'desc')
                ->get();

            return view('pages.checkout.handcash')
                ->with('category', $cate_product)
                ->with('brand', $brand_product);
        } else {
            // Thanh toán bằng thẻ ghi nợ
            // Cart::destroy();

            echo 'Thanh toán thẻ ghi nợ';
        }


        // return Redirect::to('/payment');
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('tbl_customers')
            ->where('customer_email', $email)
            ->where('customer_password', $password)
            ->first();


        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }
    }

    // Manage-Order-Admin
    // public function manage_order()
    // {
    //     $this->AuthLogin();

    //     $all_order = DB::table('tbl_order')
    //         ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
    //         ->select('tbl_order.*', 'tbl_customers.customer_name')
    //         ->orderBy('tbl_order.order_id', 'desc')->get();

    //     $manager_order = view('admin.manage_order')
    //         ->with('all_order', $all_order);
    //     return view('admin_layout')->with('admin.manage_order', $manager_order);
    // }

    // public function view_order($order_id)
    // {
    //     $this->AuthLogin();

    //     $order_by_id = DB::table('tbl_order')
    //         ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
    //         ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
    //         ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
    //         ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*')
    //         ->first();

    //     $manager_order_by_id = view('admin.view_order')
    //         ->with('order_by_id', $order_by_id);
    //     return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    // }

    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {

                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }

    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        if ($data['matp']) {
            $feeship = Feeship::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee', $fee->fee_feeship);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 20);
                    Session::save();
                }
            }
        }
    }
    public function del_fee()
    {
        Session::forget('fee');
        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $shipping = new Shipping();

        // Kiểm tra nếu có mã coupon
        if (!empty($data['order_coupon'])) {
            $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();

            // Kiểm tra coupon có tồn tại và hợp lệ
            if ($coupon) {
                $coupon->coupon_time = $coupon->coupon_time - 1;
                $coupon->save();
            } else {
                return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            }
        }

        // get van chuyen
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];

        $shipping->save();

        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);



        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if (Session::get('cart')) {
            foreach (Session::get('cart') as $key => $cart) {

                $order_details = new OrderDetails();

                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];

                $order_details->save();
            }
        }

        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
}
