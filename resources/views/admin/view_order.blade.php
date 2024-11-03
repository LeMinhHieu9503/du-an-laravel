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
                            <th>Số lượng kho còn</th>
                            <th>Mã giảm giá</th>
                            <th>Phí ship hàng</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach ($order_details as $key => $details)
                            @php
                                $i++;
                                $subtotal = $details->product_price * $details->product_sales_quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td><label><i>{{ $i }}</i></label>
                                </td>
                                <td><span class="text-ellipsis">{{ $details->product_name }}</span></td>
                                <td><span class="text-ellipsis">{{ $details->product->product_quantity }}</span></td>
                                <td><span class="text-ellipsis">
                                        @if ($details->product_coupon != 'no')
                                            {{ $details->product_coupon }}
                                        @else
                                            Không mã
                                        @endif
                                    </span></td>
                                <td>{{ number_format($details->product_feeship, 0, ',', '.') }}đ</td>
                                <td><span class="text-ellipsis">
                                        <input type="number" min="1" value="{{ $details->product_sales_quantity }}"
                                            name="product_sales_quantity">
                                        <input type="hidden" name="order_product_id" value="{{$details->product_id}}" class="order_product_id">
                                        <button class="btn btn-default" name="update_quantity">Cập nhật</button>
                                    </span></td>
                                <td><span
                                        class="text-ellipsis">{{ number_format($details->product_price, 0, ',', '.') }}đ</span>
                                </td>
                                <td><span class="text-ellipsis">{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                @php
                                    $total_coupon = 0;
                                @endphp

                                @if ($coupon_condition == 1)
                                    @php
                                        $total_after_coupon = ($total * $coupon_number) / 100;
                                        $total_coupon = $total - $total_after_coupon + $details->product_feeship;
                                    @endphp
                                @else
                                    @php
                                        $total_coupon = $total - $coupon_number + $details->product_feeship;
                                    @endphp
                                @endif

                                Tiền coupon: {{ number_format($coupon_number ?? 0, 0, ',', '.') }}đ
                                <br>
                                Phí ship: {{ number_format($details->product_feeship ?? 0, 0, ',', '.') }}đ
                                <br>
                                Thanh toán: {{ number_format($total_coupon, 0, ',', '.') }}đ
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                @foreach ($order as $key => $or)
                                    @if ($or->order_status == 1)
                                        <form action="">
                                            @csrf
                                            <select class="form-control order_details" id="">
                                                <option value="">-----Chọn hình thức đơn hàng-----</option>
                                                <option id="{{ $or->order_id }}" value="1">Chưa xử lý</option>
                                                <option id="{{ $or->order_id }}" value="2">Đã xử lý-Đã giao hàng
                                                </option>
                                                <option id="{{ $or->order_id }}" value="3">Hủy đơn hàng-tạm giữ
                                                </option>
                                            </select>
                                        </form>
                                    @elseif($or->order_status == 2)
                                        <form action="">
                                            @csrf
                                            <select class="form-control order_details" id="">
                                                <option value="">-----Chọn hình thức đơn hàng-----</option>
                                                <option id="{{ $or->order_id }}" value="1">Chưa xử lý</option>
                                                <option id="{{ $or->order_id }}" value="2" selected>Đã xử lý-Đã giao
                                                    hàng</option>
                                                <option id="{{ $or->order_id }}" value="3">Hủy đơn hàng-tạm giữ
                                                </option>
                                            </select>
                                        </form>
                                    @else
                                        <form action="">
                                            @csrf
                                            <select class="form-control order_details" id="">
                                                <option value="">-----Chọn hình thức đơn hàng-----</option>
                                                <option id="{{ $or->order_id }}" value="1">Chưa xử lý</option>
                                                <option id="{{ $or->order_id }}" value="2">Đã xử lý-Đã giao
                                                    hàng</option>
                                                <option id="{{ $or->order_id }}" value="3" selected>Hủy đơn hàng-tạm
                                                    giữ
                                                </option>
                                            </select>
                                        </form>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <br></br>
@endsection
