<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettify.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ 'frontend/images/ico/favicon.ico' }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ 'frontend/images/ico/apple-touch-icon-144-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ 'frontend/images/ico/apple-touch-icon-114-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ 'frontend/images/ico/apple-touch-icon-72-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{ 'frontend/images/logo.png' }}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                <li><a href="{{ URL::to('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a></li>

                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                <li><a href="{{ URL::to('/payment') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a>
                                </li>
                                <?php 
                                }else{
                                ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a></li>
                                <?php
                                 }
                                ?>


                                <li><a href="{{ URL::to('/gio-hang') }}"><i class="fa fa-shopping-cart"></i>
                                        Giỏ hàng
                                        <span class="badges">
                                            <span id="show-cart"></span>
                                        </span>

                                    </a></li>
                                {{-- <style>
                                    span#show-cart li {
                                        margin-top: 10px;
                                    }
                                </style> --}}
                                <span id="show-cart"></span>
                                <?php
                                        $customer_id = Session::get('customer_id');
                                        if($customer_id!=NULL){ 
                                      ?>
                                <li><a href="{{ URL::to('/history') }}" target="_blank"><i class="fa fa-bell"></i>
                                        Lịch sử đơn
                                        hàng</a></li>

                                <?php
                                 }
                                      ?>


                                {{-- Style badges --}}
                                <style>
                                    span.badges {
                                        background: red;
                                        padding: 5px;
                                        border-radius: 10px;
                                        font-size: 14px;
                                        font-weight: bold;
                                        color: #fff;
                                    }
                                </style>

                                <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        xuất</a></li>

                                <?php
                            }else{
                                 ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        nhập</a>
                                </li>
                                <?php 
                             }
                                 ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category as $key => $danhmuc)
                                            <li><a
                                                    href="{{ URL::to('/danh-muc-san-pham/' . $danhmuc->category_id) }}">{{ $danhmuc->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Bài viết<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category_post as $key => $danhmucbaiviet)
                                            <li><a
                                                    href="{{ URL::to('/danh-muc-bai-viet/' . $danhmucbaiviet->cate_post_id) }}">{{ $danhmucbaiviet->cate_post_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ url('/gio-hang') }}">
                                        Giỏ hàng
                                        <span class="badges">
                                            <span class="show-cart"></span>
                                        </span>
                                    </a></li>
                                <li><a href="{{ url('/lienhe') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="search_box pull-right">
                            <form action="{{ URL::to('tim-kiem') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" style="color: black" name="keywords_submit"
                                    placeholder="Tìm kiếm sản phẩm" />
                                <input type="submit" name="search_items" class="btn btn-info" value="Tìm kiếm">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($slider as $key => $slide)
                                @php
                                    $i++;
                                @endphp
                                <div class="item {{ $i == 1 ? 'active' : '' }}">

                                    <div class="col-sm-12">
                                        <img alt="{{ $slide->slider_desc }}"
                                            src="{{ asset('uploads/slider/' . $slide->slider_image) }}"
                                            height="300px" width="100%" class="img img-responsive img-slider">

                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach ($category as $key => $cate)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a
                                                href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand as $key => $brand)
                                        <li><a
                                                href="{{ URL::to('/thuong-hieu-san-pham/' . $brand->brand_id) }}">{{ $brand->brand_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->


                        <div class="brands_products">
                            <h2>Sản phẩm yêu thích</h2>
                            <div class="brands-name">
                                <div id="row_wishlist" class="row">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-sm-9 padding-right">
                    @yield('content')

                </div>
            </div>
        </div>
    </section>

    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Đảm bảo - Uy tín - Chất lượng</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'frontend/images/iframe1.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'frontend/images/iframe2.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'frontend/images/iframe3.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'frontend/images/iframe4.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5189936941397!2d105.81882847503094!3d21.011909980633156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab7dbe72d225%3A0xff2723e4039fb40!2zMTIwIFAuIFRow6FpIEjDoCwgVHJ1bmcgTGnhu4d0LCDEkOG7kW5nIMSQYSwgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1731267144916!5m2!1sen!2s"
                                width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ chúng tôi</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hướng dẫn mua hàng</a></li>
                                <li><a href="#">Hướng dẫn thanh toán</a></li>
                                <li><a href="#">Quy định đổi trả</a></li>
                                <li><a href="#">Điều khoản dịch vụ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Thông tin shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li>Địa chỉ: </li>
                                <li>Số điện thoại: </li>
                                <li>Email: </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Mua hàng và thanh toán Online</a></li>
                                <li><a href="#">Chính sách giao hàng</a></li>
                                <li><a href="#">Thông tin đơn mua hàng</a></li>
                                <li><a href="#">Trung tâm bảo hành chính hãng</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Đăng ký email</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Email của bạn:" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Shop chúng tôi có cập nhập gì mới nhất <br />Thông tin sẽ gửi qua email...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2024 E-SHOPPER Inc. All rights reserved.</p>

                </div>
            </div>
        </div>

    </footer><!--/Footer-->

    {{-- Style footer --}}

    <style>
        #row_wishlist {
            display: flex;
            flex-wrap: wrap;
            /* Cho phép các phần tử bọc vào khi không đủ chỗ */
            gap: 20px;
            /* Khoảng cách giữa các phần tử */
            overflow: hidden;
            /* Ngừng cuộn ngang */
        }

        .product-item {
            display: flex;
            flex-direction: column;
            /* Hiển thị theo chiều dọc */
            justify-content: center;
            align-items: center;
            width: calc(33% - 20px);
            /* Để các phần tử chiếm 1/3 chiều rộng, bạn có thể điều chỉnh giá trị này */
            box-sizing: border-box;
            /* Đảm bảo tính toán đúng kích thước */
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            /* Giữ tỷ lệ ảnh đúng */
        }

        .product-info {
            padding-top: 10px;
            text-align: center;
        }
    </style>

    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- Sweet Alert --}}
    <script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('frontend/js/prettify.js') }}"></script>

    {{-- Hủy đơn hàng --}}
    {{-- Cách này đang lỗi chỉ hủy đơn đầu --}}
    {{-- <script type="text/javascript">
        function Huydonhang(id) {
            var order_code = id;
            var lydo = $('.lydohuydon').val();
            var _token = $('input[name="_token"]').val();

            // Kiểm tra lý do
            if (!lydo.trim()) {
                alert('Vui lòng nhập lý do hủy đơn hàng!');
                return;
            }

            // Gửi AJAX
            $.ajax({
                url: '{{ url('/huy-don-hang') }}',
                method: "POST",
                data: {
                    order_code: order_code,
                    lydo: lydo,
                    _token: _token
                },
                success: function(data) {
                    alert('Hủy đơn hàng thành công');
                    location.reload(); // Làm mới trang sau khi hủy thành công
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        }
    </script> --}}
    <script type="text/javascript">
        function delete_compare(id) {
            // alert(id);
            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));
                var index = data.findIndex(item => item.id === id);

                // alert(index);
                data.splice(index, 1);
                localStorage.setItem('compare', JSON.stringify(data));
                document.getElementById("row_compare" + id).remove();
            }
        }

        // function delete_compare(id) {
        //     if (localStorage.getItem('compare') != null) {
        //         var data = JSON.parse(localStorage.getItem('compare'));
        //         var index = data.findIndex(item => item.id == id); // Lưu ý dùng `==` để so sánh chính xác
        //         if (index !== -1) { // Kiểm tra sản phẩm có tồn tại
        //             data.splice(index, 1); // Xóa sản phẩm khỏi mảng
        //             localStorage.setItem('compare', JSON.stringify(data)); // Lưu lại dữ liệu mới
        //             document.getElementById("row_compare" + id).remove(); // Xóa dòng khỏi giao diện
        //         } else {
        //             console.warn('Sản phẩm không tồn tại trong danh sách so sánh!');
        //         }
        //     }
        // }

        sosanh();

        function sosanh() {
            if (localStorage.getItem('compare') != null) {
                var data = JSON.parse(localStorage.getItem('compare'));

                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    var id = data[i].id;
                    // var content = data[i].content;
                    $('#row_compare').find('tbody').append(`
                        <tr id="row_compare` + id + `">
                            <td>` + name + `</td>
                            <td>` + price + `$</td>
                            <td>
                                <img style="width:150px;" src="` + image + `" alt="Product Image">    
                            </td>
                            <td></td>
                            <td>
                                <a href="` + url + `" >Xem chi tiết</a>
                            </td>
                            <td>
                                <a style="cursor:pointer;" onclick="delete_compare(` + id + `)">Xóa so sánh</a>    
                            </td>
                        </tr>

                    `);
                }
            }
        }


        function add_compare(product_id) {
            // alert(product_id);
            document.getElementById('title-compare').innerText = 'Chỉ cho phép so sánh tối đa 4 sản phẩm';
            var id = product_id;

            var name = document.getElementById('wishlist_productname' + id).value;
            // var content = document.getElementById('wishlist_productcontent' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
                // 'content':content
            }

            if (localStorage.getItem('compare') == null) {
                localStorage.setItem('compare', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('compare'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            });

            if (matches.length) {

            } else {
                if (old_data.length <= 4) {
                    old_data.push(newItem);
                    $('#row_compare').find('tbody').append(`

                        <tr id="row_compare` + id + `">
                            <td>` + newItem.name + `</td>
                            <td>` + newItem.price + `$</td>
                            <td>
                                <img style="width:150px;" src="` + newItem.image + `" alt="Product Image">    
                            </td>
                            <td></td>
                            <td>
                                <a href="` + url + `" >Xem sản phẩm</a>
                            </td>
                            <td>
                                <a style="cursor:pointer;" onclick="delete_compare(` + id + `)">Xóa so sánh</a>    
                            </td>
                        </tr>
                    
                    `);
                }
            }

            localStorage.setItem('compare', JSON.stringify(old_data));

            $('#sosanh').modal();
        }
    </script>

    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '600px';

                for (i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $("#row_wishlist").append(`
    <div class="row" style="margin:10px 0; display: flex; flex-direction: column; align-items: center;">
        <div style="margin-bottom: 10px; width: 100%; text-align: center;">
            <img src="${image}" width="100%" />
        </div>
        <div class="info_wishlist" style="text-align: center;">
            <p>${name}</p>
            <p style="color:#FE980F">${price}$</p>
            <a href="${url}">Đặt hàng</a>
        </div>
    </div>
`);

                }
            }
        }
        view();

        function add_wistlist(clicked_id) {
            var id = clicked_id;

            var name = document.getElementById('wishlist_productname' + id).value;
            var price = document.getElementById('wishlist_productprice' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;

            var newItem = {
                'url': url,
                'id': id,
                'name': name,
                'price': price,
                'image': image
            };

            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }

            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            });

            if (matches.length) {
                alert('Sản phẩm bạn đã yêu thích, nên không thể thêm');
            } else {
                old_data.push(newItem);

                $("#row_wishlist").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="' +
                    newItem.image + '" width="100%"></div><div class="col-md-8 info_wishlist"><p>' + newItem.name +
                    '</p> <p style="color:#FE980F">' + newItem.price + '</p> <a href="' + newItem.url +
                    '">Đặt hàng</a></div></div>');
            }

            localStorage.setItem('data', JSON.stringify(old_data));
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 3,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropdown > a').click(function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

                // Kiểm tra nếu menu con đã hiện, thì ẩn nó đi; nếu đang ẩn, thì hiện lên
                $(this).next('.sub-menu').stop(true, true).slideToggle(300);
            });

            // Đóng menu khi click bên ngoài
            $(document).click(function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.sub-menu').slideUp(300);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng !",
                        text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có muốn đặt hàng?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Cảm ơn, Mua hàng",
                        cancelButtonText: "Đóng, chưa mua!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: '{{ url('/confirm_order') }}',
                                method: 'POST',
                                data: {
                                    shipping_email: shipping_email,
                                    shipping_name: shipping_name,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    shipping_method: shipping_method,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon, // Sửa thành order_coupon
                                    _token: _token
                                },
                                success: function() {
                                    swal("Đơn hàng!", "Đơn hàng của bạn đã gửi thành công",
                                        "success");
                                }
                            });
                            window.setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                        }
                    });

                // var shipping_email = $('.shipping_email').val();
                // var shipping_name = $('.shipping_name').val();
                // var shipping_address = $('.shipping_address').val();
                // var shipping_phone = $('.shipping_phone').val();
                // var shipping_notes = $('.shipping_notes').val();
                // var shipping_method = $('.payment_select').val();
                // var order_fee = $('.order_fee').val();
                // var order_coupon = $('.order_coupon').val();
                // var _token = $('input[name="_token"]').val();

                // $.ajax({
                //     url: '{{ url('/confirm_order') }}',
                //     method: 'POST',
                //     data: {
                //         shipping_email: shipping_email,
                //         shipping_name: shipping_name,
                //         shipping_address: shipping_address,
                //         shipping_phone: shipping_phone,
                //         shipping_notes: shipping_notes,
                //         shipping_method: shipping_method,
                //         order_fee: order_fee,
                //         order_coupon: order_coupon, // Sửa thành order_coupon
                //         _token: _token
                //     },
                //     success: function() {
                //         alert('Đặt hàng thành công');
                //     }
                // });
            });
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {

            $('#sort').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location = url;
                }
                return false;
            });

        });
    </script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/load-comment') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }

            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var _token = $('input[name="_token"]').val();
                var comment_content = $('.comment_content').val();

                // Kiểm tra nếu các trường không trống
                if (comment_name === "" || comment_content === "") {
                    $('#notify_comment').html(
                        '<p class="text text-danger">Tên và nội dung bình luận không được để trống!</p>'
                    );
                    return; // Dừng lại không gửi yêu cầu AJAX
                }

                $.ajax({
                    url: "{{ url('/send-comment') }}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token,
                        comment_name: comment_name,
                        comment_content: comment_content
                    },
                    success: function(data) {
                        $('#notify_comment').html(
                            '<span class="text text-success">Thêm bình luận thành công,bình luận đang chờ duyệt!</span>'
                        );
                        load_comment(); // Cập nhật lại danh sách bình luận

                        $('#notify_comment').fadeOut(20000);
                        // Xóa nội dung đã nhập
                        $('.comment_name').val('');
                        $('.comment_content').val('');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        $('#notify_comment').html(
                            '<p class="text text-danger">Có lỗi xảy ra, vui lòng thử lại!</p>'
                        );
                    }
                });
            });

        });
    </script>
    <script type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // show cart quantity
            show_cart();

            function show_cart() {

                $.ajax({
                    url: '{{ url('/show-cart-qty') }}',
                    method: "GET",
                    success: function(data) {
                        $('#show-cart').html(data);
                        $('.show-cart').html(data);
                    }
                });
            }
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                //Kiểm tra số lượng user đặt với số lượng hàng trong kho có
                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Kho không đủ số lượng bạn mong muốn, mong bạn đặt ít hơn ' +
                        cart_product_quantity);
                } else {
                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_quantity: cart_product_quantity,
                            cart_product_qty: cart_product_qty,
                            _token: _token
                        },
                        success: function() {
                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",

                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false

                                },
                                function() {
                                    window.location.href = "{{ url('/gio-hang') }}";
                                });
                            show_cart();
                        }
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                //  alert(matp);
                //   alert(_token);

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery-home') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();

                var _token = $('input[name="_token"]').val();

                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                        url: '{{ url('/calculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            // $('#' + result).html(data);
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>


    <script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
    {{--  <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
    <script>paypal.Buttons().render('body');</script> --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    {{-- <div id="fb-root"></div> --}}
    {{-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script> --}}

</body>

</html>
