@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form">
                <h2>Đổi mật khẩu</h2>
                <form action="{{ route('changePassword') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="password" name="current_password" placeholder="Mật khẩu hiện tại" required />
                    <input type="password" name="new_password" placeholder="Mật khẩu mới" required />
                    <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required />
                    <button type="submit" class="btn btn-default">Đổi mật khẩu</button>
                    <a href="{{ url('/login-checkout') }}" class="btn btn-secondary">Quay lại Đăng nhập</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
