@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
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
                                <td class="image">Hình ảnh </td>
                                <td style="text-align: center" class="description">Tên sản phẩm</td>
                                <td style="text-align: center" class="description">Số lượng tồn</td>
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
                                        $product_qty = (float) $cart['product_qty']; // Ép kiểu về float
                                        $product_price = (float) $cart['product_price']; // Ép kiểu về float

                                        // var_dump('qty   ' . $product_qty . '<hr>');

                                        // var_dump('price   ' . $product_price . '<hr>');

                                        // var_dump('cart_price   ' . $cart['product_price']);

                                        $subtotal = $product_qty * $product_price;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="cart_product">
                                            <img src="{{ asset('uploads/product/' . $cart['product_image']) }}"
                                                height="100" width="100" alt="{{ $cart['product_name'] }}" />
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""></a></h4>
                                            <p>{{ $cart['product_name'] }}</p>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""></a></h4>
                                            <p>{{ $cart['product_quantity'] }}</p>
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
                                    <td>
                                        <div class="total_area " colspan="2">
                                            <ul class="total-list">
                                                <li>Tổng tiền :<span>{{ number_format($total, 0, ',', '.') }}$</span></li>
                                                @if (Session::get('coupon'))
                                                    <li>

                                                        @foreach (Session::get('coupon') as $key => $cou)
                                                            @if ($cou['coupon_condition'] == 1)
                                                                Mã giảm : {{ $cou['coupon_number'] }} %
                                                                <p>
                                                                    @php
                                                                        $total_coupon =
                                                                            ($total * $cou['coupon_number']) / 100;
                                                                        echo '<p><li>Tổng giảm:' .
                                                                            number_format($total_coupon, 0, ',', '.') .
                                                                            '$</li></p>';
                                                                    @endphp
                                                                </p>
                                                                <p>
                                                    <li>Tổng đã giảm
                                                        :{{ number_format($total - $total_coupon, 0, ',', '.') }}$
                                                    </li>
                                                    </p>
                                                @elseif($cou['coupon_condition'] == 2)
                                                    Mã giảm : {{ number_format($cou['coupon_number'], 0, ',', '.') }} $
                                                    <p>
                                                        @php
                                                            $total_coupon = $total - $cou['coupon_number'];

                                                        @endphp
                                                    </p>
                                                    <p>
                                                        <li>Tổng đã giảm :{{ number_format($total_coupon, 0, ',', '.') }}$
                                                        </li>
                                                    </p>
                                                @endif
                            @endforeach



                            </li>
                            @endif
                            {{-- <li>Thuế <span></span></li> --}}
                            {{-- <li>Phí vận chuyển <span>Free</span></li> --}}
                            </ul>


                            </td>
                            <td>
                                <input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
                                    class="check_out btn btn-default btn-sm">
                                <a href="{{ url('/del-all-product') }}" class="btn btn-default check_out"> Xóa tất
                                    cả sản phẩm</a>
                            </td>
                            <td>
                                @if (Session::get('coupon'))
                                    <a class="btn btn-default check_out" href="{{ url('/unset-coupon') }}">Xóa mã giảm
                                        giá</a>
                                @endif
                            </td>

                            <td>
                                @if (Session::get('customer_id'))
                                    <a class="btn btn-default check_out" href="{{ url('/checkout') }}">Đặt hàng</a>
                                @else
                                    <a class="btn btn-default check_out" href="{{ url('/login-checkout') }}">Đặt hàng</a>
                                @endif
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
                <tr>
                    <td>
                        @if (Session::get('cart'))
                    </td>
                <tr>
                    <td>

                        <form method="POST" action="{{ url('/check-coupon') }}">
                            @csrf
                            <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
                            <input type="submit" class="btn btn-default check_coupon" name="check_coupon"
                                value="Tính mã giảm giá">

                        </form>
                    </td>
                </tr>
                @endif
                </table>
            </div>
        </div>

        <!-- Nút hiển thị bảng mã giảm giá -->
        <button onclick="showCouponTable()" id="show-coupons-btn">Xem toàn bộ mã giảm giá</button>

        <!-- Nút ẩn bảng mã giảm giá (mặc định bị ẩn) -->
        <button onclick="hideCouponTable()" id="hide-coupons-btn" style="display: none;">Ẩn bảng mã giảm giá</button>
        <div id="coupon-warning" style="display: none; color: red; margin-top: 10px;">
            <p>Chỉ được sử dụng một mã giảm giá cho mỗi đơn hàng!</p>
            <p >Có thể đổi sang mã khác !</p>
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
    </section>
@endsection
