<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Statistical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatiscalController extends Controller
{
    public function index()
    {
        // Tính tổng doanh thu từ bảng OrderDetails, chỉ với những đơn hàng đã xử lý (order_status = 2)
        $totalRevenue = OrderDetails::whereHas('order', function ($query) {
            $query->where('order_status', 2); // Chỉ lấy đơn hàng có trạng thái "đã xử lý"
        })->sum(DB::raw('product_price * product_sales_quantity'));

        // Tính tổng số lượng sản phẩm bán được, chỉ với những đơn hàng đã xử lý
        $totalQuantity = OrderDetails::whereHas('order', function ($query) {
            $query->where('order_status', 2); // Chỉ lấy đơn hàng có trạng thái "đã xử lý"
        })->sum('product_sales_quantity');

        // Tính tổng số đơn hàng đã xử lý
        $totalOrders = Order::where('order_status', 2)->count();

        // Tính doanh thu trung bình mỗi đơn hàng
        $avgRevenuePerOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Lấy tất cả các chi tiết đơn hàng đã xử lý để hiển thị trong biểu đồ
        $orderDetails = OrderDetails::with(['order', 'order.shipping'])
            ->whereHas('order', function ($query) {
                $query->where('order_status', 2); // Chỉ lấy đơn hàng có trạng thái "đã xử lý"
            })
            ->get();
            
        // Truyền dữ liệu vào view
        return view('admin.statiscal.thongke', compact('totalRevenue', 'totalQuantity', 'totalOrders', 'avgRevenuePerOrder', 'orderDetails'));
    }
}
