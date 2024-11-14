@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thống kê đơn hàng
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <span><strong>Tổng doanh thu:</strong> {{ number_format($totalRevenue, 2) }} $</span><br>
                    <span><strong>Tổng sản phẩm đã bán:</strong> {{ $totalQuantity }}</span><br>
                    <span><strong>Tổng số đơn hàng:</strong> {{ $totalOrders }}</span><br>
                    <span><strong>Doanh thu trung bình mỗi đơn hàng:</strong> {{ number_format($avgRevenuePerOrder, 2) }} $</span>
                </div>
            </div>

            <!-- Biểu đồ thống kê doanh thu -->
            <div class="col-sm-12">
                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            {{-- <th>Trạng thái</th> --}}
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Phí vận chuyển</th>
                            <th>Mã giảm giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->order_code }}</td>
                                <td>{{ $detail->order->shipping->shipping_name ?? 'N/A' }}</td>
                                {{-- <td>{{ $detail->order->order_status ?? 'N/A' }}</td> --}}
                                <td>{{ $detail->product_name }}</td>
                                <td>{{ $detail->product_sales_quantity }}</td>
                                <td>{{ ($detail->product_price) }} $</td>
                                <td>{{ ($detail->product_feeship) }} $</td>
                                <td>{{ $detail->product_coupon ?? 'Không có' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Biểu đồ doanh thu
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tổng doanh thu', 'Doanh thu trung bình mỗi đơn hàng'], // Các nhãn trên trục X
                datasets: [{
                    label: 'Doanh thu',
                    data: [{{ $totalRevenue }}, {{ $avgRevenuePerOrder }}], // Dữ liệu cho các nhãn
                    backgroundColor: ['#4e73df', '#1cc88a'], // Màu sắc cho các cột
                    borderColor: ['#4e73df', '#1cc88a'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10000000, // Điều chỉnh bước trên trục Y nếu cần
                            callback: function(value) {
                                return value.toLocaleString(); // Định dạng số có dấu phẩy
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
