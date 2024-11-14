@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê mã giảm giá
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

                            <th>Tên mã giảm giá</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng mã</th>
                            <th>Điều kiện giảm giá</th>
                            <th>Số giảm giá</th>
                            <th>Tình trạng</th>

                            <th>Hết hạn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupon as $key => $cou)
                            <tr>
                                <td><span class="text-ellipsis">{{ $cou->coupon_name }}</span></td>
                                <td><span class="text-ellipsis">{{ $cou->coupon_date_start }}</span></td>
                                <td><span class="text-ellipsis">{{ $cou->coupon_date_end }}</span></td>
                                <td><span class="text-ellipsis">{{ $cou->coupon_code }}</span></td>
                                <td><span class="text-ellipsis">{{ $cou->coupon_time }}</span></td>
                                <td>
                                    <span class="text-ellipsis">
                                        <?php
                                            if($cou->coupon_condition ==1){
                                        ?>
                                        Giảm theo %
                                        <?php
                                        }else{
                                        ?>
                                        Giảm theo tiền
                                        <?php
                                        }
                                        ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="text-ellipsis">
                                        <?php
                                            if($cou->coupon_condition ==1){
                                        ?>
                                        Giảm {{ $cou->coupon_number }} %
                                        <?php
                                        }else{
                                        ?>
                                        Giảm {{ $cou->coupon_number }} $
                                        <?php
                                        }
                                        ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="text-ellipsis">
                                        <?php
                                            if($cou->coupon_status ==1){
                                        ?>
                                        <span style="color:green">Đang kích hoạt</span>
                                        <?php
                                        }else{
                                        ?>
                                        <span style="color:red">Đã khóa</span>
                                        <?php
                                        }
                                        ?>
                                    </span>
                                </td>

                                <td>
                                    @if ($cou->coupon_date_end >= $today)
                                        <span style="color:green">Còn hạn</span>
                                    @else
                                        <span style="color:red">Hết hạn</span>
                                    @endif
                                </td>
                                <td>
                                    <a onclick="return confirm('Bro chắc chắn xóa chứ?')"
                                        href="{{ URL::to('/delete-coupon/' . $cou->coupon_id) }}"
                                        class="active styling-delete" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                
            </footer>
        </div>
    </div>
@endsection
