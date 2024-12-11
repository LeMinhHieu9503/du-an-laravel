@extends('admin_layout')

@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thống kê đơn hàng
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <span><strong>Tổng doanh thu:</strong> {{ ($totalRevenue) }} $</span><br>
                    <span><strong>Tổng sản phẩm đã bán:</strong> {{ $totalQuantity }}</span><br>
                    <span><strong>Tổng số đơn hàng:</strong> {{ $totalOrders }}</span><br>
                    <span><strong>TB đơn hàng:</strong> {{ ($avgRevenuePerOrder) }}
                        $</span>
                </div>
            </div>

            <!-- Biểu đồ thống kê doanh thu -->
            <div class="col-sm-12">
                <canvas id="revenueChart" width="400" height="200"></canvas>
                <style>
                    #revenueChart {
                        width: 200px !important;
                        /* Điều chỉnh chiều rộng */
                        height: 200px !important;
                        /* Điều chỉnh chiều cao */
                    }
                </style>
            </div>
            

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Biểu đồ hình tròn (Pie chart) cho doanh thu
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'pie', // Chọn loại biểu đồ hình tròn (pie)
            data: {
                labels: ['Tổng doanh thu', 'TB đơn hàng'], // Các nhãn
                datasets: [{
                    data: [{{ $totalRevenue }}, {{ $avgRevenuePerOrder }}], // Dữ liệu cho các nhãn
                    backgroundColor: ['#4e73df', '#1cc88a'], // Màu sắc cho các phần của biểu đồ
                    borderColor: ['#4e73df', '#1cc88a'], // Màu viền cho các phần của biểu đồ
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Biểu đồ tự động điều chỉnh khi thay đổi kích thước màn hình
                plugins: {
                    legend: {
                        position: 'top', // Vị trí của legend
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() +
                                    ' $'; // Hiển thị số có dấu phẩy
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
