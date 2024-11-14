@extends('layout')
@section('content')
    @foreach ($product_details as $key => $value)
        <div class="product-details"><!--product-details-->
            <style type="text/css">
                .lSSlideOuter .lSPager.lSGallery img {
                    display: block;
                    height: 100px;
                    max-width: 100%;
                }

                li.active {
                    border: 2px solid;
                    color: orange;
                }
            </style>
            <div class="col-sm-5">
                <ul id="imageGallery">
                    @foreach ($gallery as $key => $gal)
                        <li data-thumb="{{ asset('uploads/gallery/' . $gal->gallery_image) }}"
                            data-src="{{ asset('uploads/gallery/' . $gal->gallery_image) }}">
                            <img width="100%" src="{{ asset('uploads/gallery/' . $gal->gallery_image) }}" height="450px" />
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $value->product_name }}</h2>
                    <p>Mã ID: {{ $value->product_id }}</p>
                    <img src="images/product-details/rating.png" alt="" />

                    <form action="{{ URL::to('/save-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $value->product_id }}"
                            class="cart_product_id_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_name }}"
                            class="cart_product_name_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_image }}"
                            class="cart_product_image_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_quantity }}"
                            class="cart_product_quantity_{{ $value->product_id }}">

                        <input type="hidden" value="{{ $value->product_price }}"
                            class="cart_product_price_{{ $value->product_id }}">

                        <span>
                            <span>{{ number_format($value->product_price, 0, ',', '.') . '$' }}</span>

                            <label>Số lượng:</label>
                            <input name="qty" type="number" min="1"
                                class="cart_product_qty_{{ $value->product_id }}" value="1" />
                            <input name="productid_hidden" type="hidden" value="{{ $value->product_id }}" />
                        </span>
                        <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart"
                            data-id_product="{{ $value->product_id }}" name="add-to-cart">
                    </form>


                    <p><b>Tình trạng:</b> Còn hàng</p>
                    <p><b>Điều kiện:</b> Mới 100%</p>
                    <p><b>Số lượng kho còn:</b> {{ $value->product_quantity }}</p>
                    <p><b>Thương hiệu:</b> {{ $value->brand_name }}</p>
                    <p><b>Danh mục:</b> {{ $value->category_name }}</p>

                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                            alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="details">
                        <p style="font-size: 20px">{!! $value->product_desc !!}</p>
                    </div>

                    <div class="tab-pane fade" id="companyprofile">
                        <p style="font-size: 20px">{!! $value->product_content !!}</p>
                    </div>
                </div>


                <div class="tab-pane fade active in" id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>09.11.2024</a></li>
                        </ul>
                        <style type="text/css">
                            .style_comment {
                                border: 1px solid #ddd;
                                border-radius: 10px;
                                background: rgb(191, 188, 188);
                            }
                        </style>
                        <form action="">
                            @csrf
                            <input type="hidden" name="comment_product_id" class="comment_product_id"
                                value="{{ $value->product_id }}">
                            <div id="comment_show"></div> <!-- Ajax sẽ cập nhật phần này -->

                            <p></p>
                        </form>


                        <p><b>Viết đánh giá của bạn</b></p>
                        <style>

                        </style>
                        <form action="#" class="form" method="POST">
                            @csrf
                            <span>
                                <input class="comment_name" type="text" name="comment_name"
                                    placeholder="Tên bình luận" />
                            </span>
                            <textarea class="comment_content" name="comment_content" placeholder="Nội dung bình luận:"></textarea>
                            <b>Đánh giá sao: </b> <img src="{{ asset('frontend/images/product-details/rating.png') }}"
                                alt="" />
                            <button type="button" class="btn btn-default pull-right send-comment">
                                Gửi bình luận
                            </button>
                            <div id="comment_show"></div> <!-- Ajax sẽ cập nhật phần này -->

                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    @endforeach


    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($relate as $key => $lienquan)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ URL::to('uploads/product/' . $lienquan->product_image) }}"
                                            height="100%" width="100px" alt="" />
                                        <h2>{{ number_format($lienquan->product_price) . '  ' . '$' }}</h2>
                                        <p>{{ $lienquan->product_name }}</p>
                                        <a href="" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endsection
