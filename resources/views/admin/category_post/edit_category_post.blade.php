@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục bài viết
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
                        <form role="form" method="POST" action="{{ URL::to('/update-category-post/'.$category_post->cate_post_id  ) }}">
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên danh mục -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                <input type="text" class="form-control" onkeyup="ChangeToSlug();" name="cate_post_name"
                                    value="{{ $category_post->cate_post_name }}" id="slug" placeholder="danh mục">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="cate_post_slug" class="form-control"
                                    value="{{ $category_post->cate_post_slug }}" id="convert_slug"
                                    placeholder="Tên danh mục">
                            </div>

                            <!-- Mô tả danh mục -->
                            <div class="form-group">
                                <label for="categoryProductDesc">Mô tả danh mục bài viết</label>
                                <input type="text" name="cate_post_desc" class="form-control"
                                    value="{{ $category_post->cate_post_desc }}" id="convert_slug"
                                    placeholder="Tên danh mục">
                            </div>

                            <!-- Hiển thị -->
                            <div class="form-group">
                                <label for="categoryProductDisplay">Hiển thị</label>
                                <select name="cate_post_status" class="form-control input-sm m-bot15"
                                    id="categoryProductDisplay" required>
                                    @if ($category_post->cate_post_status == 0)
                                        <option value="1">Ẩn</option>
                                        <option selected value="0">Hiển thị</option>
                                    @else
                                        <option selected value="1">Ẩn</option>
                                        <option value="0">Hiển thị</option>
                                    @endif

                                </select>
                            </div>
                            <!-- Nút Thêm -->
                            <button type="submit" name="add_post_cate" class="btn btn-info">Cập nhật danh mục bài
                                viết</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
