@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thư viện ảnh
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">' . $message . '</span>';
                        Session::forget('message'); // Xóa thông báo sau khi hiển thị
                    }
                    ?>

                    <input type="hidden" value="{{ $pro_id }}" name="pro_id" class="pro_id" id="">
                    <form action="">
                        @csrf
                        <div id="gallery_load">
                          
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
