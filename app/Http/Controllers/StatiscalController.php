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
        // Tính tổng doanh thu từ bảng OrderDetails
        $totalRevenue = OrderDetails::sum(DB::raw('product_price * product_sales_quantity'));

        // Tính tổng số lượng sản phẩm bán được
        $totalQuantity = OrderDetails::sum('product_sales_quantity');

        // Tính tổng số đơn hàng
        $totalOrders = Order::count();

        // Tính doanh thu trung bình mỗi đơn hàng
        $avgRevenuePerOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Lấy tất cả các chi tiết đơn hàng để hiển thị trong biểu đồ
        $orderDetails = OrderDetails::with(['order', 'order.shipping'])->get();

        // Truyền dữ liệu vào view
        return view('admin.statiscal.index', compact('totalRevenue', 'totalQuantity', 'totalOrders', 'avgRevenuePerOrder', 'orderDetails'));
    }
}

