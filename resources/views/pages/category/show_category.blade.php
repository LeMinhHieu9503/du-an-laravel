@extends('layout')
@section('content')
    {{-- <div class="features_items"><!--features_items-->
        <div class="fb-share-button" data-href="http://127.0.0.1:8000/trang-chu" data-layout="button_count"
        data-size="small"><a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count" data-action="like"
        data-size="small" data-share="false"></div> --}}
    @foreach ($category_name as $key => $name)
        <h2 class="title text-center">Danh mục : {{ $name->category_name }}</h2>
    @endforeach

    @foreach ($category_by_id as $key => $product)
        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">

            <div class="col-sm-6">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ URL::to('uploads/product/' . $product->product_image) }}" height="250"
                                width="250" alt="" />
                            <h2>{{ number_format($product->product_price) . '  ' . 'VNĐ' }}</h2>
                            <p>{{ $product->product_name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                giỏ hàng</a>
                        </div>

                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    </div><!--features_items-->
    <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="" data-numposts="20"></div>


@endsection
