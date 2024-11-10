@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Danh sách thông tin website
                </header>
                <div class="panel-body">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">' . $message . '</span>';
                        Session::forget('message'); // Xóa thông báo sau khi hiển thị
                    }
                    ?>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Thông tin liên hệ</th>
                                <th>Bản đồ</th>
                                <th>Logo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{!! $contact->info_contact !!}</td>
                                    <td>{!! $contact->info_map !!}</td>
                                    <td>
                                        <img src="{{ asset('uploads/contact/' . $contact->info_logo) }}" alt="Logo" width="100" />
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('/edit-info/' . $contact->info_id) }}" class="btn btn-primary btn-xs">Sửa</a>
                                        <a href="{{ URL::to('/delete-info/' . $contact->info_id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
