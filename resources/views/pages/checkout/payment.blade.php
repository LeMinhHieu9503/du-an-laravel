@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div>

            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>

            <div class="table-responsive cart_info">
                <?php
                $content = Cart::content();
                ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh </td>
                            <td class="description">Mô tả</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $v_content)
                            <tr>
                                <td class="cart_product">
                                    <a href="">
                                        <img src="{{ URL::to('uploads/product/' . $v_content->options->image) }}"
                                            height="100" width="100" alt="" />
                                    </a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $v_content->name }}</a></h4>
                                    <p>Web ID: 1089772</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($v_content->price) . ' ' . 'vnđ' }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <form action="{{ URL::to('/update-cart-quantity') }}" method="POST">
                                            {{ csrf_field() }}

                                            <input class="cart_quantity_input" type="text" name="cart_quantity"
                                                value="{{ $v_content->qty }}" size="2">

                                            <!-- Pass the rowId as a hidden input field -->
                                            <input type="hidden" name="rowId_cart" value="{{ $v_content->rowId }}">

                                            <input type="submit" value="Cập nhật" name="update_qty"
                                                class="btn btn-default btn-sm">
                                        </form>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $subtotal = $v_content->price * $v_content->qty;
                                        echo number_format($subtotal) . ' ' . 'vnđ';
                                        ?>
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        href="{{ URL::to('/delete-to-cart/' . $v_content->rowId) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="payment-options">
                <form action="{{ URL::to('/order-place') }}" method="POST" class="payment-form">
                    {{ csrf_field() }}
                    <h2 class="form-title">Phương thức thanh toán</h2>
                    <div class="payment-option">
                        <label><input name="payment_option" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
                    </div>
                    <div class="payment-option">
                        <label><input name="payment_option" value="2" type="checkbox"> Thanh toán bằng tiền mặt</label>
                    </div>
                    <div class="payment-option">
                        <label><input name="payment_option" value="3" type="checkbox"> Thanh toán bằng thẻ ghi nợ</label>
                    </div>
                    <input type="submit" value="Đặt hàng" name="send_order_place" class="submit-btn">
                </form>

            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
