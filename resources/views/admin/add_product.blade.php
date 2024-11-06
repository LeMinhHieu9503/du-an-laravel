@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" method="POST" action="{{ URL::to('/save-product') }}"
                            enctype="multipart/form-data">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên sản phẩm -->
                            <div class="form-group">
                                <label for="ProductName">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();"
                                    placeholder="Tên sản phẩm" required>
                            </div>

                            <!-- Mô tả sản phẩm -->
                            <div class="form-group">
                                <label for="ProductDesc">Mô tả sản phẩm</label>
                                <textarea name="product_desc" class="form-control" id="ckeditor" cols="30" placeholder="Mô tả sản phẩm"
                                    rows="10" required></textarea>
                            </div>

                            <!-- Nội dung sản phẩm -->
                            <div class="form-group">
                                <label for="ProductContent">Nội dung sản phẩm</label>
                                <textarea name="product_content" class="form-control" id="ckeditor1" cols="30" placeholder= "Nội dung sản phẩm"
                                    rows="10" required></textarea>
                            </div>

                            {{-- Số lượng sản phẩm --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">SL sản phẩm</label>
                                <input type="text" data-validation="number"
                                    data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity"
                                    class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                                </div>

                            <!-- Nhập Giá sản phẩm -->
                            <div class="form-group">
                                <label for="ProductPrice">Giá sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="ProductPrice"
                                    placeholder="Giá sản phẩm" required>
                            </div>

                            <!-- Hình ảnh sản phẩm -->
                            <div class="form-group">
                                <label for="ProductImage">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="ProductImgae" required>
                            </div>

                            <!-- Hiển thị checkbox Danh mục -->
                            <div class="form-group">
                                <label for="ProductDisplay">Danh mục sản phẩm</label>
                                <!-- Thay đổi tên của select danh mục sản phẩm -->
                                <select name="category_id" class="form-control input-sm m-bot15" id="ProductDisplay"
                                    required>
                                    @foreach ($cate_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Hiển thị checkbox Thương hiệu -->
                            <div class="form-group">
                                <label for="ProductDisplay">Thương hiệu sản phẩm</label>
                                <!-- Thay đổi tên của select thương hiệu sản phẩm -->
                                <select name="brand_id" class="form-control input-sm m-bot15" id="ProductDisplay" required>
                                    @foreach ($brand_product as $key => $brand)
                                        <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Hiển thị -->
                            <div class="form-group">
                                <label for="ProductDisplay">Hiển thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15" id="ProductDisplay"
                                    required>
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>
                            <!-- Nút Thêm -->
                            <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
