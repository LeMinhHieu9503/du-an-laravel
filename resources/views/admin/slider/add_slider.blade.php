@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Slider
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
                        <form role="form" method="POST" action="{{ URL::to('/insert-slider') }}">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên slider -->
                            <div class="form-group">
                                <label for="BrandProductName">Tên slider</label>
                                <input type="text" name="slider_name" class="form-control"
                                    id="BrandProductName" placeholder="Tên slider" required>
                            </div>

                            <!-- Mô tả slider -->
                            <div class="form-group">
                                <label for="BrandProductDesc">Mô tả slider</label>
                                <textarea name="slider_desc" class="form-control" id="BrandProductDesc" cols="30"
                                    placeholder="Mô tả slider" rows="10" required></textarea>
                            </div>

                            <!-- Hình ảnh slider -->
                            <div class="form-group">
                                <label for="BrandProductDesc">Mô tả slider</label>
                                <input type="file" name="slider_image" class="form-control"
                                    id="BrandProductName" placeholder="Hình ảnh slider" required>
                            </div>

                            <!-- Hiển thị -->
                            <div class="form-group">
                                <label for="BrandProductDisplay">Hiển thị</label>
                                <select name="slider_status" class="form-control input-sm m-bot15"
                                    id="BrandProductDisplay" required>
                                    <option value="1">Ẩn slider</option>
                                    <option value="0">Hiển thị slider</option>
                                </select>
                            </div>
                            <!-- Nút Thêm -->
                            <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
