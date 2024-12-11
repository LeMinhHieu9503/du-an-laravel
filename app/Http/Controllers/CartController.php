<?php

namespace App\Http\Controllers;

use App\Models\CatePost;
use App\Models\Coupon;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Để sử dụng Hash
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

session_start();

class CartController extends Controller
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
    public function save_cart(Request $request)
    {
        // $productId = $request->productid_hidden;
        // $quantity = $request->qty;

        // $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

        // $data['id'] = $product_info->product_id;
        // $data['qty'] = $quantity;
        // $data['name'] = $product_info->product_name;
        // $data['price'] = $product_info->product_price;
        // $data['weight'] = '123';
        // $data['options']['image'] = $product_info->product_image;

        // Cart::add($data);
        // return redirect('/show_cart');
        Cart::destroy();
    }

    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        return view('pages.cart.show_cart')
            ->with('category', $cate_product)
            ->with('brand', $brand_product);
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return redirect('/show_cart');
    }

    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);

        return redirect('/show_cart');
    }


    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();

        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart'); // Lấy giỏ hàng từ session

        if ($cart == true) {
            $is_avaiable = false; // Biến kiểm tra sản phẩm đã tồn tại

            foreach ($cart as $key => &$val) { // Sử dụng tham chiếu (&) để sửa trực tiếp trong mảng
                if ($val['product_id'] == $data['cart_product_id']) {
                    $val['product_qty'] += $data['cart_product_qty']; // Cộng dồn số lượng sản phẩm

                    // Kiểm tra số lượng tồn kho
                    if ($val['product_qty'] > $val['product_quantity']) {
                        $val['product_qty'] = $val['product_quantity']; // Giới hạn số lượng bằng tồn kho
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Số lượng vượt quá kho. Vui lòng đặt ít hơn.'
                        ]);
                    }

                    $is_avaiable = true; // Đánh dấu sản phẩm đã tồn tại
                    break;
                }
            }

            // Nếu sản phẩm chưa tồn tại, thêm mới
            if (!$is_avaiable) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
            }
        } else {
            // Nếu giỏ hàng rỗng, thêm sản phẩm đầu tiên
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }

        // Cập nhật lại session giỏ hàng
        Session::put('cart', $cart);
        Session::save();

        return response()->json([
            'status' => 'success',
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng'
        ]);
    }


    public function gio_hang(Request $request)
    {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();


        $url_canonical = $request->url();
        $coupons = Coupon::all();
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')->get();

        return view('pages.cart.cart_ajax')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('url_canonical', $url_canonical)
            ->with('category_post', $category_post)
            ->with('coupons', $coupons)
            ->with('slider', $slider);
    }

    public function del_product($session_id)
    {
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('message', 'Xóa sản phẩm thất bại');
        }
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');

        if ($cart) {
            $message = '';

            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    // Check if session ID matches and update quantities
                    if ($val['session_id'] == $key) {
                        if ($qty <= $val['product_quantity']) {
                            $cart[$session]['product_qty'] = $qty;
                            $message .= '<p style="color:green">Số lượng sản phẩm: ' . $val['product_name'] . ' -> thành công</p>';
                        } else {
                            $message .= '<p style="color:red">Số lượng sản phẩm: ' . $val['product_name'] . ' -> thất bại do không đủ hàng.</p>';
                        }
                    }
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back()->with('message', 'Cập nhật số lượng sản phẩm thất bại');
        }
    }



    public function del_all_product()
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            Session::forget('cart');
            Session::forget('coupon');

            return redirect()->back()->with('message', 'Xóa hết sản phẩm thành công');
        }
    }

    public function check_coupon(Request $request)
    {

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('error', 'Mã giảm giá không đúng hoặc đã hết hạn');
        }
    }

    public function show_cart_qty()
    {
        $cart = count(Session::get('cart'));
        echo $cart;
        // Trên thanh menu , khó nhìn (option khác)

        // $output = '';
        // if($cart>0){
        // $output .= '
        //     <li><a href="' . url('/gio-hang') . '"><i class="fa fa-shopping-cart"></i>
        //                                 Giỏ hàng
        //                                 <span class="badges">'.$cart.'</span>
        //                             </a></li>
        // ';
        // }else{
        //     $output .= '
        //     <li><a href="' . url('/gio-hang') . '"><i class="fa fa-shopping-cart"></i>
        //                                 Giỏ hàng
        //                                 <span class="badges">0</span>
        //                             </a></li>
        // ';
        // }


        // echo $output;
    }
}
