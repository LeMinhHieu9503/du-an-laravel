@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        @foreach ($all_product as $key => $product)
            <div class="col-sm-6">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <form>
                                @csrf
                                <input type="hidden" name="" value="{{ $product->product_id }}"
                                    class="cart_product_id_{{ $product->product_id }}">

                                <input type="hidden" name="" value="{{ $product->product_name }}"
                                    id="wishlist_productname{{ $product->product_id }}"
                                    class="cart_product_name_{{ $product->product_id }}">

                                <input type="hidden" name="" value="{{ $product->product_image }}"
                                    class="cart_product_image_{{ $product->product_id }}">

                                <input type="hidden" name="" value="{{ $product->product_quantity }}"
                                    class="cart_product_quantity_{{ $product->product_id }}">

                                <input type="hidden" name="" value="{{ number_format($product->product_price) }}"
                                    id="wishlist_productprice{{ $product->product_id }}"
                                    class="cart_product_price_{{ $product->product_id }}">

                                <input type="hidden" name="" value="1"
                                    class="cart_product_qty_{{ $product->product_id }}">

                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}"
                                    id="wishlist_producturl{{ $product->product_id }}">

                                    <img src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                                        id="wishlist_productimage{{ $product->product_id }}" alt="" />

                                    <h2>{{ number_format($product->product_price) . '  ' . 'VNĐ' }}</h2>

                                    <p>{{ $product->product_name }}</p>

                                </a>

                                <button type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart"
                                    data-id_product="{{ $product->product_id }}" name="add-to-cart">
                                    Thêm giỏ hàng
                                </button>

                            </form>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <style>
                                ul.nav.nav-pills.nav-justified li {
                                    text-align: center;
                                    font-size: 13px;
                                }

                                .button_wishlist {
                                    border: none;
                                    background: #ffff;
                                    color: #83AFA8;
                                }

                                ul.nav.nav-pills.nav-justified i {
                                    color: #83AFA8;
                                }

                                .button_wishlist span:hover {
                                    color: #FE980F;
                                }

                                .button_wishlist:focus {
                                    border: none;
                                    outline: none;
                                }
                            </style>
                            <li><a href="#">
                                    <i class="fa fa-plus-square">
                                        <button class="button_wishlist btn btn-info" id="{{ $product->product_id }}"
                                            onclick="add_wistlist(this.id);">
                                            <span>Yêu thích</span>
                                        </button>
                                    </i>
                                </a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
