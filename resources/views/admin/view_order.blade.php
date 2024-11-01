@extends('admin_layout')
@section('admin_content')
    {{-- Thông tin đăng nhập --}}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin đăng nhập
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::forget('message'); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Tên đăng nhập</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="text-ellipsis">{{ $customer->customer_name }}</span></td>
                            <td><span class="text-ellipsis">{{ $customer->customer_phone }}</span></td>
                            <td><span class="text-ellipsis">{{ $customer->customer_email }}</span></td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển hàng
            </div>

            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::forget('message'); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Tên người vận chuyển hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="text-ellipsis">{{ $shipping->shipping_name }}</span></td>
                            <td><span class="text-ellipsis"></span>{{ $shipping->shipping_address }}</td>
                            <td><span class="text-ellipsis"></span>{{ $shipping->shipping_phone }}</td>
                            <td><span class="text-ellipsis"></span>{{ $shipping->shipping_email }}</td>
                            <td><span class="text-ellipsis"></span>{{ $shipping->shipping_notes }}</td>

                            <td>
                                <span class="text-ellipsis">
                                    @if ($shipping->shipping_method == 0)
                                        Chuyển khoản
                                    @else
                                        Tiền mặt
                                    @endif
                                </span>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <br></br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::forget('message'); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total =0;
                        @endphp
                        @foreach ($order_details as $key => $details)
                            @php
                                $i++;
                                $subtotal = $details->product_price * $details->product_sales_quantity;
                                $total +=$subtotal;
                            @endphp
                            <tr>
                                <td><label><i>{{ $i }}</i></label>
                                </td>
                                <td><span class="text-ellipsis">{{ $details->product_name }}</span></td>
                                <td><span class="text-ellipsis">{{ $details->product_sales_quantity }}</span></td>
                                <td><span
                                        class="text-ellipsis">{{ number_format($details->product_price, 0, ',', '.') }}đ</span>
                                </td>
                                <td><span
                                        class="text-ellipsis">{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                </td>

                            </tr>
                        @endforeach

                        <tr>
                            <td>Thanh toán: {{number_format($total)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <br></br>
@endsection
