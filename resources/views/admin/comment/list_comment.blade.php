@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê bình luận
            </div>
            <div id="notify_comment">

            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::forget('message'); // Xóa thông báo sau khi hiển thị
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>

                            <th>Duyệt</th>
                            <th>Tên người gửi</th>
                            <th>Bình luận</th>
                            <th>Ngày gửi</th>
                            <th>Sản phẩm</th>
                            <th>Quản lý</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comment as $key => $comm)
                            <tr>
                                <td><span class="text-ellipsis">
                                        @if ($comm->comment_status == 1)
                                            <input type="button" data-comment_id="{{ $comm->comment_id }}"
                                                id="{{ $comm->comment_product_id }}" data-comment_status="0"
                                                class="btn btn-primary comment_duyet_btn" value="Duyệt">
                                        @else
                                            <input type="button" data-comment_id="{{ $comm->comment_id }}"
                                                id="{{ $comm->comment_product_id }}" data-comment_status="1"
                                                class="btn btn-danger comment_duyet_btn" value="Bỏ duyệt">
                                        @endif
                                    </span></td>
                                {{-- Thư viện ảnh gallery --}}
                                <td><span class="text-ellipsis">{{ $comm->comment_name }}</span></td>
                                {{-- Reply --}}
                                <td><span class="text-ellipsis">{{ $comm->comment_content }}
                                        @if ($comm->comment_status == 0)
                                            <br>
                                            <textarea name="comment_content" id="" class="form-control reply_comment_{{$comm->comment_id}}" rows="5"></textarea>
                                            <br>
                                            <button class="btn btn-info btn-reply-comment" data-comment_id="{{ $comm->comment_id }}" data-product_id="{{ $comm->comment_product_id }}">Trả lời bình luận</button>
                                            @endif
                                    </span></td>

                                <td><span class="text-ellipsis">{{ $comm->comment_date }}</span></td>

                                <td><span class="text-ellipsis">
                                        <a href="{{ url('/chi-tiet-san-pham/' . $comm->product->product_id) }}"
                                            target="blank">{{ $comm->product->product_name }}</a>
                                    </span></td>

                                <td>
                                    <a href="" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bro chắc chắn xóa chứ?')" href=""
                                        class="active styling-delete" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
