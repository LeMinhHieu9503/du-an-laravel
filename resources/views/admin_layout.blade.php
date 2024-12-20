<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('backend/js/morris.js') }}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('backend/images/2.png') }}">
                            <span class="username">
                                <?php
                                $name = Auth::user()->admin_name;
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/logout-auth') }}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{ URL::to('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-category-product') }}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{ URL::to('all-category-product') }}">Liệt kê danh mục sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-brand-product') }}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{ URL::to('all-brand-product') }}">Liệt kê thương hiệu sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-category-post') }}">Thêm danh mục bài viết</a></li>
                                <li><a href="{{ URL::to('all-category-post') }}">Liệt kê danh mục bài viết</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bài viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-post') }}">Thêm bài viết</a></li>
                                <li><a href="{{ URL::to('all-post') }}">Liệt kê bài viết</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/add-product') }}">Thêm sản phẩm</a></li>
                                <li><a href="{{ URL::to('all-product') }}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-order') }}">Quản lý đơn hàng</a></li>
                                {{-- <li><a href="{{ URL::to('all-category-product') }}">Liệt kê danh mục sản phẩm</a></li> --}}
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/delivery') }}">Quản lý vận chuyển</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Coupon</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/insert-coupon') }}">Thêm mã giảm giá</a></li>
                                <li><a href="{{ URL::to('list-coupon') }}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Silder banner</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/manage-slider') }}">Liệt kê slider</a></li>
                                <li><a href="{{ URL::to('add-slider') }}">Thêm slider</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Comment</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/comment') }}">Liệt kê comment</a></li>
                            </ul>

                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thông tin website</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/information') }}">Thêm thông tin</a></li>
                                <li><a href="{{ URL::to('/list-information') }}">Liệt kê thông tin</a></li>
                            </ul>
                        </li>
                        @impersonate
                            <li>
                                <span>
                                    <a href="{{ URL::to('/impersonate-destroy') }}">Stop chuyển quyền</a>
                                </span>
                            </li>
                        @endimpersonate

                        @hasrole(['admin', 'author'])
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Users</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{ URL::to('/add-users') }}">Thêm user</a></li>
                                    <li><a href="{{ URL::to('/users') }}">Liệt kê user</a></li>

                                </ul>
                            </li>
                        @endhasrole
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thống kê</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{ URL::to('/statiscal') }}">Thống kê</a></li>
                            </ul>
                        </li>


                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('admin_content')

            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2024 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a>
                    </p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script src="{{ asset('backend/js/jquery.form-validator.min.js') }}"></script>

    <script>
        $(function() {
            $("#start_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
            $("#end_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
        });
    </script>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                duration: "slow"
            });
        });
    </script>

    <script type="text/javascript">
        $('.comment_duyet_btn').click(function() {
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');

            var alertMessage = (comment_status == 0) ?
                'Thay đổi thành duyệt thành công' :
                'Thay đổi thành bỏ duyệt thành công';

            $.ajax({
                url: "{{ url('/allow-comment') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment_status: comment_status,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id
                },
                success: function(data) {
                    location.reload();
                    $('#notify_comment').html('<span class="text text-success">' + alertMessage +
                        '</span>');
                    setTimeout(function() {
                        $('#notify_comment').html('');
                    }, 50000);
                }
            });

        });

        $('.btn-reply-comment').click(function() {
            var comment_id = $(this).data('comment_id');

            var comment = $('.reply_comment_' + comment_id).val();
            var comment_product_id = $(this).data('product_id');

            var alert = 'Trả lời thành công';
            // alert(comment);
            // alert(comment_id);
            // alert(comment_product_id);


            $.ajax({
                url: "{{ url('/reply-comment') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    comment: comment,
                    comment_id: comment_id,
                    comment_product_id: comment_product_id
                },
                success: function(data) {
                    // location.reload();
                    $('#notify_comment').html('<span class="text text-success">' + alert +
                        '</span>');
                    $('.reply_comment_' + comment_id).val('');
                }
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();

                // alert(pro_id);
                $.ajax({
                    url: "{{ url('/select-gallery') }}",
                    method: "POST",
                    data: {
                        _token: _token,
                        pro_id: pro_id
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }

            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                // Check for file count
                if (files.length > 5) {
                    error += '<p>Bạn chọn tối đa chỉ 5 ảnh</p>';
                } else if (files.length === 0) {
                    error += '<p>Bạn không được bỏ trống ảnh</p>';
                } else {
                    // Check each file size
                    for (var i = 0; i < files.length; i++) {
                        if (files[i].size > 200000000) { // 2MB in bytes
                            error += '<p>File ảnh không được lớn hơn 2MB</p>';
                            break;
                        }
                    }
                }

                if (error === '') {
                    $('#error_gallery').html(''); // Clear error if no issues
                } else {
                    $('#file').val(''); // Clear the file input
                    $('#error_gallery').html('<span class="text-danger">' + error +
                        '</span>'); // Display error
                }
            });

            $(document).on('blur', '.edit_gal_name', function() {
                // alert('Ahiahiahifh')
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();

                // alert(gal_id);
                // alert(gal_text);
                $.ajax({
                    url: "{{ url('/update-gallery-name') }}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token

                    },
                    success: function(data) {
                        // $('#gallery_load').html(data);
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhật tên hình ảnh thành công</span>'
                        );
                    }
                });
            });

            $(document).on('click', '.delete-gallery', function() {
                // alert('Ahiahiahifh')
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();

                // alert(gal_id);
                // alert(gal_text);
                if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                    $.ajax({
                        url: "{{ url('/delete-gallery') }}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            _token: _token

                        },
                        success: function(data) {
                            // $('#gallery_load').html(data);
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-danger">Xóa hình ảnh thành công</span>');
                        }
                    });
                }
            });


            $(document).on('change', '.file_image', function() {
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-' + gal_id).files[0];

                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
                form_data.append("gal_id", gal_id);

                $.ajax({
                    url: "{{ url('/update-gallery') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-success">Cập nhật hình ảnh thành công</span>'
                        );
                    },
                    error: function() {
                        $('#error_gallery').html(
                            '<span class="text-danger">Có lỗi xảy ra, vui lòng thử lại.</span>'
                        );
                    }
                });
            });

        });
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    {{-- Button update chi tiết đơn hàng --}}
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            // alert('đã click');
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);
            $.ajax({
                url: '{{ url('/update-qty') }}',
                method: 'POST',
                data: {
                    _token: _token,
                    order_product_id: order_product_id,
                    order_qty: order_qty,
                    order_code: order_code
                },
                success: function(data) {
                    alert('Cập nhật số lượng thành công');
                    location.reload();
                }
            });

        })
    </script>
    <script type="text/javascript">
        // Update số lượng hàng hóa trong view_order admin
        $('.order_details').change(function() {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();
            // alert(order_status);
            // alert(order_id);
            // alert(_token);

            //Lấy ra số lượng sản phẩm
            quantity = [];
            $("input[name='product_sales_quantity']").each(function() {
                quantity.push($(this).val());
            });
            //Lấy ra product_id để đem đi so sánh
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });
            j = 0;
            //So sánh số lượng tồn kho với số lượng đặt hàng của đơn
            for (i = 0; i < order_product_id.length; i++) {
                // alert(order_product_id[i]);
                // Số lượng khách đặt
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                // Số lượng tồn kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                // alert(order_qty);
                // alert(order_qty_storage);
                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j = j + 1;
                    if (j = 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_' + order_product_id[i]).css('background', '#000');
                }
            }
            // alert(j);
            if (j == 0) {
                $.ajax({
                    url: '{{ url('/update-order-qty') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        order_status: order_status,
                        order_id: order_id,
                        quantity: quantity,
                        order_product_id: order_product_id
                    },
                    success: function(data) {
                        // $('#load_delivery').html(data);
                        alert('Thay đổi tình trạng đơn hàng thành công');
                        location.reload();
                    }
                });

            }

        });
    </script>

    {{-- Update phí ship dựa theo địa chỉ --}}
    <script type="text/javascript">
        $(document).ready(function() {

            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.fee_feeship_edit', function() {

                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/update-delivery') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });

            });
            $('.add_delivery').click(function() {

                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                // alert(city);
                // alert(province);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url: '{{ url('/insert-delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        _token: _token,
                        wards: wards,
                        fee_ship: fee_ship
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });


            });
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
                    url: '{{ url('/select-delivery') }}',
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
        })
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    {{-- Update số lượng hàng hóa  --}}
    <script type="text/javascript">
        $('.update_quantity_order').click(function() {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_' + order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);
            $.ajax({
                url: '{{ url('/update-qty') }}',

                method: 'POST',

                data: {
                    _token: _token,
                    order_product_id: order_product_id,
                    order_qty: order_qty,
                    order_code: order_code
                },
                // dataType:"JSON",
                success: function(data) {

                    alert('Cập nhật số lượng thành công');

                    location.reload();




                }
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            fetch_delivery();

            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur', '.fee_feeship_edit', function() {

                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                // alert(feeship_id);
                // alert(fee_value);
                $.ajax({
                    url: '{{ url('/update-delivery') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        fee_value: fee_value,
                        _token: _token
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });

            });
            $('.add_delivery').click(function() {

                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                // alert(city);
                // alert(province);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url: '{{ url('/insert-delivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        _token: _token,
                        wards: wards,
                        fee_ship: fee_ship
                    },
                    success: function(data) {
                        fetch_delivery();
                    }
                });


            });
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
                    url: '{{ url('/select-delivery') }}',
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
            $('#myTable').DataTable();
        });
    </script>
    <script type="text/javascript">
        $.validate({

        });
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
        CKEDITOR.replace('id4');
    </script>


    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
    <!-- morris JavaScript -->
    <script>
        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('backend/js/monthly.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#mycalendar').monthly({
                mode: 'event',

            });

            $('#mycalendar2').monthly({
                mode: 'picker',
                target: '#mytarget',
                setWidth: '250px',
                startHidden: true,
                showTrigger: '#mytarget',
                stylePast: true,
                disablePast: true
            });

            switch (window.location.protocol) {
                case 'http:':
                case 'https:':
                    // running on a server, should be good.
                    break;
                case 'file:':
                    alert('Just a heads-up, events will not work when run locally.');
            }

        });
    </script>
    <!-- //calendar -->
</body>

</html>
