@extends('layout')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
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
                                            Đơn hàng chưa xử lý
                                        @elseif($ord->order_status == 2)
                                            Đơn hàng đã xử lý
                                        @else
                                            Đơn hàng đã hủy - tạm giữ
                                        @endif
                                    </span></td>

                                <td>
                                    <a href="{{ URL::to('/view-hisstory-order/' . $ord->order_code) }}" class="active styling-edit"
                                        ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <footer class="panel-footer">
              <div class="row">
                <div class=""></div>
                <div class="col-sm-7 text-right text-center-xs">
                  <ul class="pagination pagination-sm m-t-none m-b-none">
                    {{$order->links()}}
                  </ul>
                </div>
              </div>
            </footer>
        </div>
    </div>
@endsection
