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
                                            <span class="text text-success">Đơn hàng đã xử lý</span>
                                        @else
                                            <span class="text text-danger">Đơn hàng đã bị hủy</span>
                                        @endif
                                    </span></td>

                                <td>
                                    <a href="{{ URL::to('/view-hisstory-order/' . $ord->order_code) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i>
                                    </a>
                                </td>
                                {{-- Cách này đang bị lỗi chỉ hủy được đơn đầu tiên , auto đơn đầu --}}
                                {{-- <td>
                                    @if($ord->order_status !=3)
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#huydon">Hủy đơn hàng</button>
                                    @endif
                                    <!-- Modal -->
                                    <div id="huydon" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <form>
                                                @csrf
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Lý do hủy đơn hàng: </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            <textarea required placeholder="Lý do hủy đơn hàng .....(Bắt buộc)" rows="5" class="lydohuydon"></textarea>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info"
                                                            data-dismiss="modal">Đóng</button>
                                                        <button type="button" onclick="Huydonhang(this.id)"
                                                            id="{{ $ord->order_code }}" class="btn btn-success">
                                                            Gửi lí do
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </td> --}}
                                <td>
                                    @if($ord->order_status == 1) <!-- Chỉ hiển thị form hủy khi đơn hàng chưa xử lý -->
                                    <form action="{{ route('huy-don-hang') }}" method="POST" id="form-huy-don">
                                        @csrf
                                        <input type="hidden" name="order_code" value="{{ $ord->order_code }}">
                                        
                                        <!-- Nút Hủy Đơn Hàng -->
                                        <button type="button" class="btn btn-danger" id="huy-don-btn">Hủy đơn hàng</button>
                                    
                                        <!-- Phần nhập lý do (ẩn ban đầu) -->
                                        <div id="lydo-container" style="display: none;">
                                            <textarea name="lydo" placeholder="Lý do hủy đơn hàng..." required rows="3" class="form-control mt-2"></textarea>
                                            <button type="submit" class="btn btn-success mt-2">Gửi lý do</button>
                                        </div>
                                    </form>
                                    <script>
                                        document.getElementById("huy-don-btn").addEventListener("click", function() {
                                            // Hiển thị phần nhập lý do
                                            document.getElementById("lydo-container").style.display = "block";
                                            // Ẩn nút "Hủy đơn hàng" sau khi nhấn
                                            this.style.display = "none";
                                        });
                                    </script>
                                    @endif
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
                            {{ $order->links() }}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
