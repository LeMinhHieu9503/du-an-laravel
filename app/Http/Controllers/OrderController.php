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
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

session_start();

class OrderController extends Controller
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
    public function view_order($order_code)
    {
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        $category_post = CatePost::orderBy('cate_post_id', 'DESC')->get();


        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach ($order_details as $key => $order_d) {
            $product_coupon = $order_d->product_coupon;
        }

        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        } else {
            $coupon_condition  = 2;
            $coupon_number = 0;
        }
        return view('admin.view_order')->with(compact('order_details', 'customer', 'shipping', 'order_details', 'coupon_condition', 'coupon_number', 'order', 'order_status', 'category_post'));
    }
    public function manage_order()
    {
        $order = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }


    // --------------------------------------------------------------
    // Update hàng tồn kho

    public function update_order_qty(Request $request)
    {
        // Lấy tất cả dữ liệu từ request
        $data = $request->all();

        // Cập nhật trạng thái đơn hàng
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        // Duyệt qua từng sản phẩm trong đơn hàng
        foreach ($data['order_product_id'] as $key => $product_id) {
            // Tìm sản phẩm theo ID
            $product = Product::find($product_id);
            $product_quantity = $product->product_quantity;
            $product_sold = $product->product_sold;

            foreach ($data['quantity'] as $key2 => $qty) {
                // Kiểm tra nếu ID sản phẩm khớp với số lượng
                if ($key == $key2) {
                    if ($order->order_status == 2) {
                        // Tính số lượng còn lại và cập nhật nếu đơn hàng là "Đã xử lý"
                        $pro_remin = $product_quantity - $qty;
                        $product->product_quantity = $pro_remin;

                        // Cập nhật số lượng đã bán
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                    } elseif ($order->order_status != 2 && $order->order_status != 3) {
                        // Khôi phục số lượng nếu đơn hàng không ở trạng thái "Đã xử lý" hoặc "Đã huỷ"
                        $pro_remin = $product_quantity + $qty;
                        $product->product_quantity = $pro_remin;

                        // Giảm số lượng đã bán
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    // Update số lượng đặt hàng admin
    public function update_qty(Request $request)
    {
        $data = $request->all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    // Xóa đơn hàng
    public function order_code(Request $request, $order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $order->delete();
        Session::put('message', 'Xóa đơn hàng thành công');
        return redirect()->back();
    }
}
