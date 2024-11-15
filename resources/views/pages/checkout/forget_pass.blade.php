@extends('layout')

@section('content')
    <section id="form">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Quên mật khẩu</h2>
                        <!-- Form để nhập email -->
                        <form action="{{ url('/forget-pass') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="email" name="email" placeholder="Nhập email của bạn" />
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-default">Gửi</button>
                        </form>
                        <a href="{{ url('/login-checkout') }}" class="btn btn-secondary">Quay lại Đăng nhập</a>

                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Định dạng form quên mật khẩu */
            #form .login-form {
                background-color: #f9f9f9;
                /* Màu nền nhẹ */
                padding: 30px;
                /* Khoảng cách bên trong */
                border-radius: 8px;
                /* Bo góc */
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                /* Đổ bóng */
                text-align: center;
            }

            #form .login-form h2 {
                font-size: 24px;
                color: #333;
                margin-bottom: 20px;
            }

            #form .login-form input[type="email"] {
                width: 100%;
                /* Độ rộng tối đa */
                padding: 10px;
                /* Khoảng cách bên trong */
                margin-bottom: 15px;
                /* Khoảng cách dưới */
                border: 1px solid #ddd;
                /* Viền */
                border-radius: 4px;
                font-size: 16px;
                color: #555;
            }

            #form .login-form .btn-default {
                background-color: #5cb85c;
                /* Màu nền */
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
            }

            #form .login-form .btn-default:hover {
                background-color: #4cae4c;
                /* Màu nền khi hover */
            }

            /* Định dạng nút quay lại đăng nhập */
            #form .login-form .btn-secondary {
                background-color: #f0f0f0;
                color: #333;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                font-size: 14px;
                margin-top: 10px;
                text-decoration: none;
                display: inline-block;
            }

            #form .login-form .btn-secondary:hover {
                background-color: #ddd;
                /* Màu nền khi hover */
            }
        </style>
    </section>

@endsection
