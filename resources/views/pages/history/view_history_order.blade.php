@extends('layout')
@section('content')
    {{-- Thông tin đăng nhập --}}
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Xem chi tiết đơn hàng đã đặt
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
                                $product_price = (float) $details->product_price; // Ép kiểu về float
                                $product_quantity = (int) $details->product_sales_quantity; // Ép kiểu về int
                                $subtotal = $product_price * $product_quantity;
                                $total += $subtotal;
                            @endphp
                            <tr class="color_qty_{{ $details->product_id }}">
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
                                <td>{{ $details->product_feeship }}$</td>
                                <td>
                                    <input type="number" min="1" readonly
                                        {{ $order_status == 2 ? 'disabled' : '' }}
                                        value="{{ $details->product_sales_quantity }}" name="product_sales_quantity"
                                        class="order_qty_{{ $details->product_id }}">

                                    <input type="hidden" name="order_qty_storage"
                                        value="{{ $details->product->product_quantity }}"
                                        class="order_qty_storage_{{ $details->product_id }}">

                                    <input type="hidden" name="order_code" value="{{ $details->order_code }}"
                                        class="order_code">

                                    <input type="hidden" name="order_product_id" value="{{ $details->product_id }}"
                                        class="order_product_id">

                                </td>
                                <td><span class="text-ellipsis">{{ $details->product_price }}$</span>
                                </td>

                                <td><span class="text-ellipsis">{{ number_format($subtotal, 0, ',', '.') }}$</span>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                @php
                                    $total_coupon = 0;
                                    $total_after_coupon = 0;
                                @endphp

                                @if ($coupon_condition == 1)
                                    @php
                                        // Giảm giá theo phần trăm
                                        $total_after_coupon = ($total * $coupon_number) / 100;
                                        $total_coupon = $total - $total_after_coupon + ($details->product_feeship ?? 0);
                                    @endphp
                                    Tiền coupon giảm: {{ number_format($total_after_coupon, 0, ',', '.') }}$
                                @elseif ($coupon_condition == 2)
                                    @php
                                        // Giảm giá số tiền cố định
                                        $total_coupon = $total - $coupon_number + ($details->product_feeship ?? 0);
                                    @endphp
                                    Tiền coupon giảm: {{ number_format($coupon_number, 0, ',', '.') }}$
                                @endif
                                <br>

                                Phí ship: {{ number_format($details->product_feeship ?? 0, 0, ',', '.') }}$
                                <br>
                                Thanh toán: {{ number_format($total_coupon, 0, ',', '.') }}$
                            </td>
                        </tr>

                    </tbody>

                </table>
                
                @if ($shipping->shipping_method == 0)
                    <form action="{{ url('/vnpay_payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_vnpay" value="{{ $total_coupon }}">
                        <button type="submit" class="btn btn-default check_out" name="redirect">Thanh toán VNPay</button>
                    </form>

                    <form action="{{ url('/momo_payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_momo" value="{{ $total_coupon }}">
                        <button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán MOMO</button>
                    </form>

                    <form action="{{ url('/momo_payment_qr') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_momo_qr" value="">
                        <button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán MOMO QR</button>
                    </form>
                @endif
            </div>

        </div>
    </div>

    <br></br>
@endsection
