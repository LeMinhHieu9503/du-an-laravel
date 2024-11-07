@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm bài viết
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
                        <form role="form" method="POST" action="{{ URL::to('/save-post') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <!-- Nhập tên bài viết -->
                            <div class="form-group">
                                <label for="post_title">Tên bài viết</label>
                                <input type="text" name="post_title" class="form-control" onkeyup="ChangeToSlug();"
                                       id="slug" placeholder="Tên bài viết" required>
                            </div>

                            <!-- Nhập slug bài viết -->
                            <div class="form-group">
                                <label for="post_slug">Post-Slug</label>
                                <input type="text" name="post_slug" class="form-control" id="convert_slug"
                                       placeholder="Slug" required>
                            </div>

                            <!-- Tóm tắt bài viết -->
                            <div class="form-group">
                                <label for="post_content">Tóm tắt bài viết</label>
                                <textarea name="post_content" class="form-control" id="post_content" cols="30" placeholder="Tóm tắt bài viết"
                                          rows="5" required></textarea>
                            </div>

                            <!-- Mô tả bài viết -->
                            <div class="form-group">
                                <label for="post_desc">Mô tả bài viết</label>
                                <textarea name="post_desc" class="form-control" id="post_desc" cols="30" placeholder="Mô tả bài viết"
                                          rows="5" required></textarea>
                            </div>

                            <!-- Nội dung bài viết -->
                            <div class="form-group">
                                <label for="post_meta_desc">Nội dung bài viết</label>
                                <textarea name="post_meta_desc" class="form-control" id="post_meta_desc" cols="30" placeholder="Nội dung bài viết"
                                          rows="5" required></textarea>
                            </div>

                            <!-- Hình ảnh bài viết -->
                            <div class="form-group">
                                <label for="ProductImage">Hình ảnh bài viết</label>
                                <input type="file" name="post_image" class="form-control" id="ProductImage" required>
                            </div>

                            <!-- Chọn danh mục bài viết -->
                            <div class="form-group">
                                <label for="cate_post_id">Danh mục bài viết</label>
                                <select name="cate_post_id" class="form-control input-sm m-bot15" id="cate_post_id" required>
                                    @foreach ($cate_post as $cate)
                                        <option value="{{ $cate->cate_post_id }}">{{ $cate->cate_post_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Hiển thị bài viết -->
                            <div class="form-group">
                                <label for="post_status">Hiển thị</label>
                                <select name="post_status" class="form-control input-sm m-bot15" id="post_status" required>
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiển thị</option>
                                </select>
                            </div>

                            <!-- Nút Thêm bài viết -->
                            <button type="submit" name="add_post" class="btn btn-info">Thêm bài viết</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
