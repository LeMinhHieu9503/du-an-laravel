@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa thông tin website
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
                        <!-- Form chỉnh sửa thông tin -->
                        <form role="form" action="{{ URL::to('/update-info/' . $contact->info_id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }} <!-- Specify method as PUT for update -->

                            <!-- Thông tin liên hệ -->
                            <div class="form-group">
                                <label for="info_contact">Thông tin liên hệ</label>
                                <textarea name="info_contact" class="form-control" id="ckeditor" rows="10" required>{{ $contact->info_contact }}</textarea>
                            </div>

                            <!-- Bản đồ -->
                            <div class="form-group">
                                <label for="info_map">Bản đồ</label>
                                <textarea name="info_map" class="form-control" rows="5" required>{{ $contact->info_map }}</textarea>
                            </div>

                            <!-- Hình ảnh logo -->
                            <div class="form-group">
                                <label for="info_logo">Logo</label>
                                <input type="file" name="info_logo" class="form-control">
                                <img src="{{ asset('uploads/contact/' . $contact->info_logo) }}" alt="Logo" width="100" />
                            </div>

                            <!-- Nút Cập nhật -->
                            <button type="submit" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
