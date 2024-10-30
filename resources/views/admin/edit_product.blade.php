@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <!-- Hiển thị thông báo từ Session -->
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::forget('message'); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <div class="panel-body">
                    @foreach ($edit_product as $key => $pro)
                        <div class="position-center">
                            <!-- Form bắt đầu -->
                            <form role="form" method="POST" action="{{ URL::to('/update-product/' . $pro->product_id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <!-- Nhập tên sản phẩm -->
                                <div class="form-group">
                                    <label for="ProductName">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="ProductName"
                                        value="{{ $pro->product_name }}">
                                </div>

                                <!-- Nhập Giá sản phẩm -->
                                <div class="form-group">
                                    <label for="ProductPrice">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="ProductPrice"
                                        value="{{ $pro->product_price }}">
                                </div>

                                {{-- Nhập số lượng sản phẩm --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SL sản phẩm</label>
                                    <input type="text" data-validation="number"
                                        data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity"
                                        class="form-control" id="convert_slug" value="{{ $pro->product_quantity }}">
                                </div>

                                <!-- Nhập Hình ảnh sản phẩm -->
                                <div class="form-group">
                                    <label for="ProductImage">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="ProductImage">
                                    <img src="{{ URL::to('uploads/product/' . $pro->product_image) }}" height="100"
                                        width="100" alt="">
                                </div>

                                <!-- Mô tả sản phẩm -->
                                <div class="form-group">
                                    <label for="ProductDesc">Mô tả sản phẩm</label>
                                    <textarea name="product_desc" class="form-control" id="ProductDesc" cols="30" placeholder="Mô tả sản phẩm"
                                        rows="10">{{ $pro->product_desc }}</textarea>
                                </div>

                                <!-- Nội dung sản phẩm -->
                                <div class="form-group">
                                    <label for="Productcontent">Nội dung sản phẩm</label>
                                    <textarea name="product_content" class="form-control" id="Productcontent" cols="30" placeholder="Nội dung sản phẩm"
                                        rows="10">{{ $pro->product_content }}</textarea>
                                </div>

                                <!-- Hiển thị danh mục sản phẩm -->
                                <div class="form-group">
                                    <label for="CategorySelect">Danh mục sản phẩm</label>
                                    <select name="category_id" class="form-control input-sm m-bot15" id="CategorySelect">
                                        @foreach ($cate_product as $key => $cate)
                                            <option value="{{ $cate->category_id }}"
                                                {{ $cate->category_id == $pro->category_id ? 'selected' : '' }}>
                                                {{ $cate->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hiển thị thương hiệu sản phẩm -->
                                <div class="form-group">
                                    <label for="BrandSelect">Thương hiệu sản phẩm</label>
                                    <select name="brand_id" class="form-control input-sm m-bot15" id="BrandSelect">
                                        @foreach ($brand_product as $key => $brand)
                                            <option value="{{ $brand->brand_id }}"
                                                {{ $brand->brand_id == $pro->brand_id ? 'selected' : '' }}>
                                                {{ $brand->brand_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hiển thị trạng thái sản phẩm -->
                                <div class="form-group">
                                    <label for="ProductStatus">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15" id="ProductStatus">
                                        <option value="0" {{ $pro->product_status == 0 ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="1" {{ $pro->product_status == 1 ? 'selected' : '' }}>Ẩn
                                        </option>
                                    </select>
                                </div>

                                <!-- Nút Cập nhật -->
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            <!-- Form kết thúc -->
                        </div>
                </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
