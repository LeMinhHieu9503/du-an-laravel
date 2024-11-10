@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thông tin website
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
                        <form role="form" action="{{ URL::to('/save-info') }}" method="POST" enctype="multipart/form-data">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Thông tin liên hệ -->
                            <div class="form-group">
                                <label for="BrandProductDesc">Thông tin liên hệ</label>
                                <textarea name="info_contact" class="form-control" id="ckeditor" cols="30" placeholder="Thông tin liên hệ"
                                    rows="10" required></textarea>
                            </div>

                            <!-- Thông tin liên hệ -->
                            <div class="form-group">
                                <label for="BrandProductDesc">Bản đồ</label>
                                <textarea name="info_map" class="form-control" id="BrandProductDesc" cols="30" placeholder="Thông tin liên hệ"
                                    rows="5" required></textarea>
                            </div>

                            <!-- Hình ảnh sản phẩm -->
                            <div class="form-group">
                              <label for="Productlogo">Hình ảnh logo</label>
                              <input type="file" name="info_logo" class="form-control" id="ProductImgae" required>
                          </div>

                            <!-- Nút Thêm -->
                            <button type="submit" name="add_info" class="btn btn-info">Thông tin</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
