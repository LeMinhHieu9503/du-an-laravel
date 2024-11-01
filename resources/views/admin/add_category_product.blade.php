@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
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
                        <form role="form" method="POST" action="{{ URL::to('/save-category-product') }}">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên danh mục -->
                            <div class="form-group">
                                <label for="categoryProductName">Tên danh mục</label>
                                <input type="text" name="category_product_name" class="form-control"
                                    id="categoryProductName" placeholder="Tên danh mục" required>
                            </div>

                            <!-- Mô tả danh mục -->
                            <div class="form-group">
                                <label for="categoryProductDesc">Mô tả danh mục</label>
                                <textarea name="category_product_desc" class="form-control" id="categoryProductDesc" cols="30"
                                    placeholder="Mô tả danh mục" rows="10" required></textarea>
                            </div>

                            <!-- Hiển thị -->
                            <div class="form-group">
                                <label for="categoryProductDisplay">Hiển thị</label>
                                <select name="category_product_status" class="form-control input-sm m-bot15"
                                    id="categoryProductDisplay" required>
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                            <!-- Nút Thêm -->
                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
