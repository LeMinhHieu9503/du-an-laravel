@extends('layout')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li style="    background-color: orange; 
    color: #ffffff;
    font-weight: bold;
    padding: 10px; 
    border-radius: 5px; 
"
                        class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div>

            <div class="register-req">
                <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
            </div><!--/register-req-->
            <style>
                .btn-history {
                    display: inline-block;
                    background-color: orange;
                    /* Nền sáng */
                    color: black;
                    font-size: 20px;
                    padding: 10px 20px;
                    /* Thêm padding giống như một nút */
                    text-align: center;
                    text-decoration: none;
                    /* Bỏ gạch chân */
                    border: 1px solid #ccc;
                    /* Viền mờ */
                    border-radius: 5px;
                    /* Bo tròn viền */
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                    /* Hiệu ứng khi hover */
                }

                .btn-history:hover {
                    background-color: #e9ecef;
                    /* Nền khi hover */
                }
            </style>
            <a href="{{ url('history') }}" target="_blank" class="btn-history">Xem lại lịch sử đơn hàng</a>

            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Điền thông tin gửi hàng</p>
                            <div class="form-container">
                                <div class="form-one">
                                    <form method="POST">
                                        @csrf
                                        <input type="text" name="shipping_email" class="shipping_email"
                                            placeholder="Điền email" value="{{ $customer->customer_email ?? '' }}"  >
                                        <input type="text" name="shipping_name" class="shipping_name"
                                            placeholder="Họ và tên" value="{{ $customer->customer_name ?? '' }}" >
                                        <input type="text" name="shipping_address" class="shipping_address"
                                            placeholder="Địa chỉ gửi hàng" >
                                        <input type="text" name="shipping_phone" class="shipping_phone"
                                            placeholder="Số điện thoại"value="{{ $customer->customer_phone ?? '' }}"  >
                                        <textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>

                                        {{-- Fee --}}
                                        @if (Session::get('fee'))
                                            <input type="hidden" name="order_fee" class="order_fee"
                                                value="{{ Session::get('fee') }}">
                                        @else
                                            <input type="hidden" name="order_fee" class="order_fee" value="20000">
                                        @endif
                                        {{-- Coupon --}}
                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $key => $cou)
                                                <input type="hidden" name="order_coupon" class="order_coupon"
                                                    value="{{ $cou['coupon_code'] }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                        @endif

                                        <div class="form-group">
                                            <label for="payment_select">Chọn hình thức thanh toán</label>
                                            <select name="payment_select"
                                                class="form-control input-sm m-bot15 payment_select">
                                                <option value="0">Qua chuyển khoản</option>
                                                <option value="1">Tiền mặt</option>
                                            </select>
                                        </div>
                                        <input type="button" value="Xác nhận đơn hàng" name="send_order"
                                            class="btn btn-primary btn-sm send_order">
                                    </form>
                                </div>

                                <div class="form-two">
                                    <form>
                                        @csrf
                                        <div class="form-group">
                                            <label for="city">Chọn thành phố</label>
                                            <select name="city" id="city"
                                                class="form-control input-sm m-bot15 choose city">
                                                <option value="">--Chọn tỉnh thành phố--</option>
                                                @foreach ($city as $key => $ci)
                                                    <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="province">Chọn quận huyện</label>
                                            <select name="province" id="province"
                                                class="form-control input-sm m-bot15 province choose">
                                                <option value="">--Chọn quận huyện--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="wards">Chọn xã phường</label>
                                            <select name="wards" id="wards"
                                                class="form-control input-sm m-bot15 wards">
                                                <option value="">--Chọn xã phường--</option>
                                            </select>
                                        </div>

                                        <input type="button" value="Tính phí vận chuyển" name="calculate_order"
                                            class="btn btn-primary btn-sm calculate_delivery">
                                    </form>

                                    @if (Session::get('cart'))
                                        <tr>
                                            <td>

                                                <form method="POST" action="{{ url('/check-coupon') }}">
                                                    @csrf
                                                    <input type="text" class="form-control" name="coupon"
                                                        placeholder="Nhập mã giảm giá"><br>
                                                    <input style="background-color: orange" type="submit"
                                                        class="btn btn-default check_coupon" name="check_coupon"
                                                        value="Tính mã giảm giá">


                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    <button onclick="showCouponTable()" id="show-coupons-btn">Xem toàn bộ mã giảm
                                        giá</button>

                                    <!-- Nút ẩn bảng mã giảm giá (mặc định bị ẩn) -->
                                    <button onclick="hideCouponTable()" id="hide-coupons-btn" style="display: none;">Ẩn
                                        bảng mã giảm giá</button>
                                    <div id="coupon-warning" style="display: none; color: red; margin-top: 10px;">
                                        <p>Chỉ được sử dụng một mã giảm giá cho mỗi đơn hàng!</p>
                                        <p>Có thể đổi sang mã khác !</p>
                                    </div>
                                    <!-- Bảng mã giảm giá -->

                                    <div id="coupon-table" class="coupon-table" style="display: none;">
                                        <h3>Các mã giảm giá hiện có</h3>
                                        <table>
                                            <tr>
                                                <th>Tên Mã Giảm Giá</th>
                                                <th>Mã giảm giá</th>
                                                <th>Giảm</th>
                                                <th>Ngày hết hạn</th>
                                            </tr>
                                            @foreach ($coupons as $coupon)
                                                <tr>
                                                    <td>{{ $coupon->coupon_name }}</td>
                                                    <td>{{ $coupon->coupon_code }}</td>
                                                    <td>
                                                        @if ($coupon->coupon_condition == 1)
                                                            {{ $coupon->coupon_number }} %
                                                        @else
                                                            {{ number_format($coupon->coupon_number, 0, ',', '.') }} VND
                                                        @endif
                                                    </td>
                                                    <td>{{ $coupon->coupon_date_end }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 clearfix">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {!! session()->get('error') !!}
                            </div>
                        @endif
                        <div class="table-responsive cart_info">

                            <form action="{{ url('/update-cart') }}" method="POST">
                                @csrf
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Hình ảnh</td>
                                            <td class="description">Tên sản phẩm</td>
                                            <td class="price">Giá sản phẩm</td>
                                            <td class="quantity">Số lượng</td>
                                            <td class="total">Thành tiền</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Session::get('cart') == true)
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach (Session::get('cart') as $key => $cart)
                                                @php
                                                    $product_price = (float) $cart['product_price']; // Ép kiểu về float
                                                    $product_qty = (int) $cart['product_qty']; // Ép kiểu về int
                                                    $subtotal = $product_price * $product_qty;
                                                    $total += $subtotal;
                                                @endphp


                                                <tr>
                                                    <td class="cart_product">
                                                        <img src="{{ asset('uploads/product/' . $cart['product_image']) }}"
                                                            width="90" alt="{{ $cart['product_name'] }}" />
                                                    </td>
                                                    <td class="cart_description">
                                                        <h4><a href=""></a></h4>
                                                        <p>{{ $cart['product_name'] }}</p>
                                                    </td>
                                                    <td class="cart_price">
                                                        <p>{{ $cart['product_price'] }}$</p>
                                                    </td>
                                                    <td class="cart_quantity">
                                                        <div class="cart_quantity_button">
                                                            <input class="cart_quantity" type="number" min="1"
                                                                name="cart_qty[{{ $cart['session_id'] }}]"
                                                                value="{{ $cart['product_qty'] }}">
                                                        </div>
                                                    </td>
                                                    <td class="cart_total">
                                                        <p class="cart_total_price">
                                                            {{ number_format($subtotal, 0, ',', '.') }}$

                                                        </p>
                                                    </td>
                                                    <td class="cart_delete">
                                                        <a class="cart_quantity_delete"
                                                            href="{{ url('/del-product/' . $cart['session_id']) }}"><i
                                                                class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
                                                        class="check_out btn btn-default btn-sm"></td>
                                                <td><a class="btn btn-default check_out"
                                                        href="{{ url('/del-all-product') }}">Xóa tất cả</a></td>

                                                <td>
                                                    @if (Session::get('coupon'))
                                                        <a class="btn btn-default check_out"
                                                            href="{{ url('/unset-coupon') }}">Xóa mã khuyến mãi</a>
                                                    @endif
                                                </td>


                                                <td colspan="2">
                                                    <li>Tổng tiền :<span>{{ number_format($total, 0, ',', '.') }}$</span>
                                                    </li>
                                                    @if (Session::get('coupon'))
                                                        <li>

                                                            @foreach (Session::get('coupon') as $key => $cou)
                                                                @if ($cou['coupon_condition'] == 1)
                                                                    Mã giảm : {{ $cou['coupon_number'] }} %
                                                                    <p>
                                                                        @php
                                                                            $total_coupon =
                                                                                ($total * $cou['coupon_number']) / 100;
                                                                        @endphp
                                                                    </p>
                                                                    <p>
                                                                        @php
                                                                            $total_after_coupon =
                                                                                $total - $total_coupon;
                                                                        @endphp
                                                                    </p>
                                                                @elseif($cou['coupon_condition'] == 2)
                                                                    Mã giảm :
                                                                    {{ number_format($cou['coupon_number'], 0, ',', '.') }}$
                                                                    <p>
                                                                        @php
                                                                            $total_coupon =
                                                                                $total - $cou['coupon_number'];

                                                                        @endphp
                                                                    </p>
                                                                    @php
                                                                        $total_after_coupon = $total_coupon;
                                                                    @endphp
                                                                @endif
                                                            @endforeach



                                                        </li>
                                                    @endif

                                                    @if (Session::get('fee'))
                                                        <li>
                                                            <a class="cart_quantity_delete"
                                                                href="{{ url('/del-fee') }}"><i
                                                                    class="fa fa-times"></i></a>

                                                            Phí vận chuyển
                                                            <span>{{ number_format(Session::get('fee'), 0, ',', '.') }}$</span>
                                                        </li>
                                                        <?php $total_after_fee = $total + Session::get('fee'); ?>
                                                    @endif
                                                    <li>Tổng còn:
                                                        @php
                                                            if (Session::get('fee') && !Session::get('coupon')) {
                                                                $total_after = $total_after_fee;
                                                                echo number_format($total_after, 0, ',', '.') . '$';
                                                            } elseif (!Session::get('fee') && Session::get('coupon')) {
                                                                $total_after = $total_after_coupon;
                                                                echo number_format($total_after, 0, ',', '.') . '$';
                                                            } elseif (Session::get('fee') && Session::get('coupon')) {
                                                                $total_after = $total_after_coupon;
                                                                $total_after = $total_after + Session::get('fee');
                                                                echo number_format($total_after, 0, ',', '.') . '$';
                                                            } elseif (!Session::get('fee') && !Session::get('coupon')) {
                                                                $total_after = $total;
                                                                echo number_format($total_after, 0, ',', '.') . '$';
                                                            }

                                                        @endphp
                                                    </li>

                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="5">
                                                    <center>
                                                        @php
                                                            echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                                                        @endphp
                                                    </center>
                                                </td>


                                            </tr>
                                        @endif

                                    </tbody>



                            </form>
                            {{-- <td>
                                {{-- <form action="{{ url('/vnpay_payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total_vnpay" value="{{$total_after}}">
                                    <button type="submit" class="btn btn-default check_out" name="redirect">Thanh toán
                                        VNPay</button>
                                </form> --}}

                            {{-- <form action="{{ url('/momo_payment') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total_momo" value="{{$total_after}}">
                                    <button type="submit" class="btn btn-default check_out" name="payUrl">Thanh toán
                                        MOMO</button>
                                </form> --}}
                            {{-- </td> --}}
                            {{-- @if (Session::get('cart'))
                                <tr>
                                    <td>

                                        <form method="POST" action="{{ url('/check-coupon') }}">
                                            @csrf
                                            <input type="text" class="form-control" name="coupon"
                                                placeholder="Nhập mã giảm giá"><br>
                                            <input type="submit" class="btn btn-default check_coupon"
                                                name="check_coupon" value="Tính mã giảm giá">


                                        </form>
                                    </td>
                                </tr>
                            @endif --}}

                            </table>



                        </div>
                    </div>

                </div>
            </div>




        </div>
        <!-- Nút hiển thị bảng mã giảm giá -->
        {{-- <button onclick="showCouponTable()" id="show-coupons-btn">Xem toàn bộ mã giảm giá</button>

        <!-- Nút ẩn bảng mã giảm giá (mặc định bị ẩn) -->
        <button onclick="hideCouponTable()" id="hide-coupons-btn" style="display: none;">Ẩn bảng mã giảm giá</button>
        <div id="coupon-warning" style="display: none; color: red; margin-top: 10px;">
            <p>Chỉ được sử dụng một mã giảm giá cho mỗi đơn hàng!</p>
            <p>Có thể đổi sang mã khác !</p>
        </div>
        <!-- Bảng mã giảm giá -->

        <div id="coupon-table" class="coupon-table" style="display: none;">
            <h3>Các mã giảm giá hiện có</h3>
            <table>
                <tr>
                    <th>Tên Mã Giảm Giá</th>
                    <th>Mã giảm giá</th>
                    <th>Giảm</th>
                    <th>Ngày hết hạn</th>
                </tr>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->coupon_name }}</td>
                        <td>{{ $coupon->coupon_code }}</td>
                        <td>
                            @if ($coupon->coupon_condition == 1)
                                {{ $coupon->coupon_number }} %
                            @else
                                {{ number_format($coupon->coupon_number, 0, ',', '.') }} VND
                            @endif
                        </td>
                        <td>{{ $coupon->coupon_date_end }}</td>
                    </tr>
                @endforeach
            </table>
        </div> --}}

        <script>
            // Hiển thị bảng mã giảm giá và thanh thông báo
            function showCouponTable() {
                document.getElementById("coupon-table").style.display = "block"; // Hiển thị bảng
                document.getElementById("show-coupons-btn").style.display = "none"; // Ẩn nút "Xem toàn bộ mã giảm giá"
                document.getElementById("hide-coupons-btn").style.display = "inline"; // Hiển thị nút "Ẩn bảng mã giảm giá"
                document.getElementById("coupon-warning").style.display = "block"; // Hiển thị thanh thông báo
            }

            // Ẩn bảng mã giảm giá và thanh thông báo
            function hideCouponTable() {
                document.getElementById("coupon-table").style.display = "none"; // Ẩn bảng
                document.getElementById("show-coupons-btn").style.display = "inline"; // Hiển thị nút "Xem toàn bộ mã giảm giá"
                document.getElementById("hide-coupons-btn").style.display = "none"; // Ẩn nút "Ẩn bảng mã giảm giá"
                document.getElementById("coupon-warning").style.display = "none"; // Ẩn thanh thông báo
            }
        </script>
        <style>
            /* Thông báo */
            #coupon-warning {
                background-color: #f8d7da;
                /* Màu nền đỏ nhạt */
                color: #721c24;
                /* Màu chữ đỏ đậm */
                border: 1px solid #f5c6cb;
                /* Viền nhẹ màu đỏ nhạt */
                padding: 15px;
                border-radius: 5px;
                /* Bo góc nhẹ */
                font-size: 16px;
                /* Cỡ chữ vừa */
                margin-top: 20px;
                /* Khoảng cách phía trên */
                width: 100%;
                /* Chiều rộng thanh thông báo */
                box-sizing: border-box;
                /* Đảm bảo padding không làm thay đổi kích thước */
            }

            #coupon-warning p {
                margin: 0;
                /* Loại bỏ margin mặc định của <p> */
                font-weight: bold;
                /* Chữ đậm */
            }

            #coupon-warning i {
                margin-right: 10px;
                /* Khoảng cách giữa biểu tượng và văn bản */
            }

            /* Nút hiển thị và ẩn bảng mã giảm giá */
            button {
                padding: 10px 20px;
                font-size: 16px;
                color: #fff;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
                margin-top: 10px;
            }

            button:hover {
                background-color: #0056b3;
            }

            /* Bảng mã giảm giá */
            .coupon-table {
                margin-top: 20px;
                text-align: center;
                max-width: 600px;
                margin: 0 auto;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                background-color: #fff;
                overflow: hidden;
            }

            .coupon-table h3 {
                padding: 15px;
                background-color: #007bff;
                color: #fff;
                font-size: 20px;
                margin: 0;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
            }

            /* Bảng mã giảm giá - bảng dữ liệu */
            .coupon-table table {
                width: 100%;
                border-collapse: collapse;
            }

            .coupon-table th,
            .coupon-table td {
                padding: 12px 15px;
                border-bottom: 1px solid #ddd;
            }

            .coupon-table th {
                background-color: #f8f9fa;
                color: #333;
                font-weight: bold;
            }

            .coupon-table td {
                color: #555;
            }

            .coupon-table tr:last-child td {
                border-bottom: none;
            }
        </style>
    </section> <!--/#cart_items-->

@endsection
