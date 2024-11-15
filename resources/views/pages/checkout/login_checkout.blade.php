@extends('layout')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập tài khoản</h2>
                        <form action="{{ URL::to('/login-customer') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="email_account" placeholder="Tài khoản" />
                            <input type="password" name="password_account" placeholder="Password" />
                            <span>
                                <input type="checkbox" class="checkbox">
                                Ghi nhớ đăng nhập
                            </span>
                            <br>
                            <span>
                                <a href="{{ url('/forget-pass') }}">Quên mật khẩu</a>
                                <a href="{{ url('/change-pass') }}">Đổi mật khẩu</a>
                            </span>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                        <style>
                            /* Định dạng cho hai liên kết trong form đăng nhập */
                            .login-form span a {
                                color: #337ab7;
                                /* Màu xanh */
                                text-decoration: none;
                                padding: 0 10px;
                                /* Khoảng cách ngang giữa các liên kết */
                                font-size: 14px;
                            }

                            .login-form span a:hover {
                                color: #23527c;
                                /* Màu khi di chuột */
                                text-decoration: underline;
                                /* Gạch chân khi di chuột */
                            }

                            /* Khoảng cách giữa checkbox và liên kết */
                            .login-form span {
                                display: inline-block;
                                margin-top: 10px;
                            }
                        </style>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="{{ URL::to('/add-customer') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="text" name="customer_name" placeholder="Họ và tên" />
                            <input type="email" name="customer_email" placeholder="Địa chỉ email" />
                            <input type="password" name="customer_password" placeholder="Mật khẩu" />
                            <input type="text" name="customer_phone" placeholder="Phone" />
                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>

    </section><!--/form-->
@endsection
