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
                            <!-- Thêm token bảo mật nếu bạn dùng Laravel -->
                            {{ csrf_field() }}

                            <!-- Nhập tên thương hiệu -->
                            <div class="form-group">
                              <label for="exampleInputEmail1">Tên bài viết</label>
                              <input type="text" name="post_title" class="form-control" onkeyup="ChangeToSlug();"
                                  id="slug" placeholder="Tên danh mục" >
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Post-Slug</label>
                              <input type="text" name="post_slug" class="form-control" id="convert_slug"
                                  placeholder="Slug">
                          </div>

                          <!-- Mô tả thương hiệu -->
                          <div class="form-group">
                              <label for="BrandProductDesc">Tóm tắt bài viết</label>
                              <textarea name="post_content" class="form-control" id="BrandProductDesc" cols="30" placeholder="Mô tả thương hiệu"
                                  rows="10" ></textarea>
                          </div>

                          <!-- Mô tả thương hiệu -->
                          <div class="form-group">
                              <label for="BrandProductDesc">Mô tả bài viết</label>
                              <textarea name="post_desc" class="form-control" id="BrandProductDesc" cols="30" placeholder="Mô tả thương hiệu"
                                  rows="10" ></textarea>
                          </div>

                          <!-- Mô tả thương hiệu -->
                          <div class="form-group">
                              <label for="BrandProductDesc">Nội dung bài viết</label>
                              <textarea name="post_meta_desc" class="form-control" id="BrandProductDesc" cols="30"
                                  placeholder="Mô tả thương hiệu" rows="10" ></textarea>
                          </div>

                          <!-- Mô tả thương hiệu -->
                          <div class="form-group">
                            <label for="BrandProductDesc">Từ khóa bài viết</label>
                            <textarea name="post_meta_keywords" class="form-control" id="BrandProductDesc" cols="30"
                                placeholder="Mô tả thương hiệu" rows="10" ></textarea>
                        </div>

                          <!-- Hình ảnh sản phẩm -->
                          <div class="form-group">
                              <label for="ProductImage">Hình ảnh sản phẩm</label>
                              <input type="file" name="post_image" class="form-control" id="ProductImgae" >
                          </div>
                          <!-- Hiển thị danh mục bài viết-->
                          <div class="form-group">
                              <label for="BrandProductDisplay">Hiển thị</label>
                              <select name="cate_post_id" class="form-control input-sm m-bot15"
                                  id="BrandProductDisplay">
                                  @foreach ($cate_post as $key => $cate)
                                      <option value="{{ $cate->cate_post_id }}">{{ $cate->cate_post_name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <!-- Hiển thị -->
                          <div class="form-group">
                              <label for="BrandProductDisplay">Hiển thị</label>
                              <select name="post_status" class="form-control input-sm m-bot15"
                                  id="BrandProductDisplay">
                                  <option value="1">Ẩn</option>
                                  <option value="0">Hiển thị</option>
                              </select>
                          </div>
                          <!-- Nút Thêm -->
                          <button type="submit" name="add_post" class="btn btn-info">Thêm bài viết</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
