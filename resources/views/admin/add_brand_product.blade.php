@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
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
                        <form role="form" method="POST" action="{{ URL::to('/save-brand-product') }}">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên thương hiệu -->
                            <div class="form-group">
                                <label for="BrandProductName">Tên thương hiệu</label>
                                <input type="text" name="brand_product_name" class="form-control"
                                    id="BrandProductName" placeholder="Tên thương hiệu" required>
                            </div>

                            <!-- Mô tả thương hiệu -->
                            <div class="form-group">
                                <label for="BrandProductDesc">Mô tả thương hiệu</label>
                                <textarea name="brand_product_desc" class="form-control" id="BrandProductDesc" cols="30"
                                    placeholder="Mô tả thương hiệu" rows="10" required></textarea>
                            </div>

                            <!-- Hiển thị -->
                            <div class="form-group">
                                <label for="BrandProductDisplay">Hiển thị</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15"
                                    id="BrandProductDisplay" required>
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                            <!-- Nút Thêm -->
                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
