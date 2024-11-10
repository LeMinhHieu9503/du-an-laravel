@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bình luận
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
                    <div class="position-center">
                        <!-- Form bắt đầu -->
                        <form role="form" method="POST" action="{{ URL::to('/update-comment/' . $comment->comment_id) }}">
                            <!-- Thêm token bảo mật -->
                            {{ csrf_field() }}

                            <!-- Nhập tên người dùng -->
                            <div class="form-group">
                                <label for="commentName">Tên người dùng</label>
                                <input type="text" name="comment_name" class="form-control" id="commentName" value="{{ $comment->comment_name }}" readonly>
                            </div>

                            <!-- Nội dung bình luận -->
                            <div class="form-group">
                                <label for="commentContent">Nội dung bình luận</label>
                                <textarea name="comment_content" class="form-control" id="commentContent" cols="30" rows="5" required>{{ $comment->comment_content }}</textarea>
                            </div>


                            <!-- Nút Cập nhật -->
                            <button type="submit" name="update_comment" class="btn btn-info">Cập nhật bình luận</button>
                        </form>
                        <!-- Form kết thúc -->
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
