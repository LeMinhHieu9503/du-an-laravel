@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mã giảm giá
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">' . $message . '</span>';
                        Session::forget('message'); // Xóa thông báo sau khi hiển thị
                    }
                    ?>
                    <div class="position-center">
                        <!-- Form bắt đầu -->
                        <form role="form" method="POST" action="{{ URL::to('/insert-coupon-code') }}">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên mã giảm giá -->
                            <div class="form-group">
                                <label for="categoryProductName">Tên mã giảm giá</label>
                                <input type="text" name="coupon_name" class="form-control"
                                    id="" placeholder="Tên mã giảm giá" required>
                            </div>

                            <div class="form-group">
                                <label for="categoryProductName">Ngày bắt đầu</label>
                                <input type="text" name="coupon_date_start" class="form-control"
                                    id="start_coupon" placeholder="Tên mã giảm giá" required>
                            </div>

                            <div class="form-group">
                                <label for="categoryProductName">Ngày kết thúc</label>
                                <input type="text" name="coupon_date_end" class="form-control"
                                    id="end_coupon" placeholder="Tên mã giảm giá" required>
                            </div>

                            <!-- Nhập mã giảm giá -->
                            <div class="form-group">
                                <label for="categoryProductName">Mã giảm giá</label>
                                <input type="text" name="coupon_code" class="form-control"
                                    id="categoryProductName" placeholder="Mã giảm giá" required>
                            </div>

                            <!-- Tính năng mã giảm giá -->
                            <div class="form-group">
                                <label for="categoryProductDesc">Tính năng mã giảm giá</label>
                                <select name="coupon_condition" class="form-control input-sm m-bot15"
                                    id="categoryProductDisplay" required>
                                    <option value="0">-------Chọn--------</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                            </div>

                            <!-- Số lượng mã giảm giá -->
                            <div class="form-group">
                                <label for="categoryProductDesc">Số lượng mã giảm giá</label>
                                <input type="text" name="coupon_time" class="form-control"
                                    id="categoryProductName" placeholder="Mã giảm giá" required>
                            </div>

                            <!-- Nhập số % hoặc tiền giảm -->
                            <div class="form-group">
                                <label for="categoryProductDesc">Nhập số % hoặc tiền giảm</label>
                                <input type="text" name="coupon_number" class="form-control"
                                    id="categoryProductName" placeholder="Mã giảm giá" required>
                            </div>

                            <!-- Nút Thêm -->
                            <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
