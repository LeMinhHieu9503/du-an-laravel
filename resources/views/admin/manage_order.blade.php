@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
            </div>
            <div class="row w3-res-tb">

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
                            <th>Thứ tự</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày tháng đặt hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Lý do hủy</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($order as $key => $ord)
                            @php
                                $i++;
                            @endphp

                            <tr>
                                <td><label><i>{{ $i }}</i></label>
                                </td>
                                <td><span class="text-ellipsis">{{ $ord->order_code }}</span></td>
                                <td><span class="text-ellipsis">{{ $ord->created_at }}</span></td>
                                <td><span class="text-ellipsis">
                                        @if ($ord->order_status == 1)
                                            <span class="text text-info">Đơn hàng mới</span>
                                        @elseif($ord->order_status == 2)
                                            <span class="text text-success">Đơn hàng đã xử lý</span>
                                        @else
                                            <span class="text text-danger">Đơn hàng đã bị hủy</span>
                                        @endif
                                    </span></td>
                                <td>
                                    @if ($ord->order_status == 3)
                                        {{ $ord->order_destroy }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ URL::to('/view-order/' . $ord->order_code) }}" class="active styling-edit"
                                        ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
                                        href="{{ URL::to('/delete-order/' . $ord->order_code) }}"
                                        class="active styling-edit" ui-toggle-class="">
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
