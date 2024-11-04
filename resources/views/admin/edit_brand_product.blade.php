@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu sản phẩm
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
                    @foreach ($edit_brand_product as $key => $edit_value)
                        <div class="position-center">
                            <!-- Form bắt đầu -->
                            <form role="form" method="POST"
                                action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}">
                                <!-- Thêm token bảo mật -->
                                {{ csrf_field() }}

                                <!-- Nhập tên thương hiệu -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_value->brand_name}}"  onkeyup="ChangeToSlug();" name="brand_product_name" class="form-control" id="slug" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->brand_slug}}" name="brand_product_slug" class="form-control" id="convert_slug" >
                                </div>
                                
                                <!-- Mô tả thương hiệu -->
                                <div class="form-group">
                                    <label for="brandProductDesc">Mô tả thương hiệu</label>
                                    <textarea name="brand_product_desc" class="form-control" id="brandProductDesc" cols="30"
                                        placeholder="Mô tả thương hiệu" rows="10" required>{{ $edit_value->brand_desc }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                                
                                <!-- Nút Cập nhật -->
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh
                                    mục</button>
                            </form>
                            <!-- Form kết thúc -->
                        </div>
                </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
