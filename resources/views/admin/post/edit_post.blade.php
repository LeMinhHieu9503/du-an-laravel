@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bài viết
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
                    @foreach ($edit_post as $key => $edit_value)
                        <div class="position-center">
                            <!-- Form bắt đầu -->
                            <form role="form" method="POST" action="{{ URL::to('/update-post/' . $edit_value->post_id) }}"
                                enctype="multipart/form-data">
                                <!-- Thêm token bảo mật -->
                                {{ csrf_field() }}

                                <!-- Nhập tên bài viết -->
                                <div class="form-group">
                                    <label for="post_title">Tên bài viết</label>
                                    <input type="text" value="{{ $edit_value->post_title }}" onkeyup="ChangeToSlug();"
                                        name="post_title" class="form-control" id="slug" required>
                                </div>

                                <!-- Slug bài viết -->
                                <div class="form-group">
                                    <label for="post_slug">Slug</label>
                                    <input type="text" value="{{ $edit_value->post_slug }}" name="post_slug"
                                        class="form-control" id="convert_slug" required>
                                </div>

                                <!-- Tóm tắt bài viết -->
                                <div class="form-group">
                                    <label for="post_desc">Tóm tắt bài viết</label>
                                    <textarea name="post_desc" class="form-control" id="post_desc" cols="30" rows="5" required>{{ $edit_value->post_desc }}</textarea>
                                </div>

                                <!-- Nội dung bài viết -->
                                <div class="form-group">
                                    <label for="post_content">Mô tả bài viết</label>
                                    <textarea name="post_content" class="form-control" id="post_content" cols="30" rows="10" required>{{ $edit_value->post_content }}</textarea>
                                </div>

                                <!-- Nội dung bài viết -->
                                <div class="form-group">
                                  <label for="post_content">Nội dung bài viết</label>
                                  <textarea name="post_meta_desc" class="form-control" id="post_content" cols="30" rows="10" required>{{ $edit_value->post_meta_desc }}</textarea>
                              </div>

                                <!-- Hình ảnh bài viết -->
                                <div class="form-group">
                                    <label for="post_image">Hình ảnh bài viết</label>
                                    <input type="file" name="post_image" class="form-control" id="post_image">
                                    <img src="{{ URL::to('uploads/post/' . $edit_value->post_image) }}" height="100"
                                        width="100" alt="Post Image">
                                </div>

                                <!-- Danh mục bài viết -->
                                <div class="form-group">
                                    <label for="cate_post_id">Danh mục bài viết</label>
                                    <select name="cate_post_id" class="form-control input-sm m-bot15" id="cate_post_id"
                                        required>
                                        @foreach ($cate_post as $cate)
                                            <option value="{{ $cate->cate_post_id }}"
                                                {{ $cate->cate_post_id == $edit_value->cate_post_id ? 'selected' : '' }}>
                                                {{ $cate->cate_post_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Trạng thái hiển thị -->
                                <div class="form-group">
                                    <label for="post_status">Hiển thị</label>
                                    <select name="post_status" class="form-control input-sm m-bot15" id="post_status"
                                        required>
                                        <option value="1" {{ $edit_value->post_status == 1 ? 'selected' : '' }}>Ẩn
                                        </option>
                                        <option value="0" {{ $edit_value->post_status == 0 ? 'selected' : '' }}>Hiển
                                            thị</option>
                                    </select>
                                </div>

                                <!-- Nút Cập nhật -->
                                <button type="submit" name="update_post" class="btn btn-info">Cập nhật bài viết</button>
                            </form>
                            <!-- Form kết thúc -->
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
el