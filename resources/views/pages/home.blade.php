@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        <style>
            /* Cải thiện style cho form lọc */
            .row {
                display: flex;
                justify-content: left;
                padding: 20px;
            }

            .col-md-4 {
                width: 100%;
                max-width: 400px;
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }

            label {
                font-weight: bold;
                margin-bottom: 10px;
                display: block;
                font-size: 16px;
            }

            select {
                width: 100%;
                padding: 8px 12px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                background-color: #fff;
                transition: border-color 0.3s ease;
            }

            select:focus {
                border-color: #5c7cfa;
                outline: none;
            }

            button[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: #5c7cfa;
                color: #fff;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button[type="submit"]:hover {
                background-color: #4a6fc1;
            }

            option {
                padding: 10px;
            }

            /* Style cho các trường select khi có lựa chọn */
            select option[selected] {
                background-color: #f1f1f1;
            }
        </style>
        {{-- Sắp xếp --}}
        <div class="row">
            <div class="col-md-4">
                <label for="sort">Sắp xếp theo</label>
                <form action="{{ url()->current() }}" method="get">
                    <!-- Lọc theo thương hiệu -->
                    <select name="brand_id">
                        <option value="">Chọn thương hiệu</option>
                        @foreach ($brand as $brand_item)
                            <option value="{{ $brand_item->brand_id }}" @if (request('brand_id') == $brand_item->brand_id) selected @endif>
                                {{ $brand_item->brand_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Lọc theo danh mục sản phẩm -->
                    <select name="category_id">
                        <option value="">Chọn danh mục</option>
                        @foreach ($category as $category_item)
                            <option value="{{ $category_item->category_id }}"
                                @if (request('category_id') == $category_item->category_id) selected @endif>
                                {{ $category_item->category_name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Lọc theo giá -->
                    <select name="sort">
                        <option value="">Sắp xếp theo</option>
                        <option value="giam_dan" @if (request('sort') == 'giam_dan') selected @endif>Giảm dần</option>
                        <option value="tang_dan" @if (request('sort') == 'tang_dan') selected @endif>Tăng dần</option>
                        <option value="kytu_az" @if (request('sort') == 'kytu_az') selected @endif>Chữ cái A-Z</option>
                        <option value="kytu_za" @if (request('sort') == 'kytu_za') selected @endif>Chữ cái Z-A</option>
                    </select>

                    <button type="submit">Lọc</button>
                </form>
            </div>


        </div>
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

                                <input type="hidden" name="" value="{{ $product->product_content }}"
                                    id="wishlist_productcontent{{ $product->product_id }}">

                                <input type="hidden" name="" value="1"
                                    class="cart_product_qty_{{ $product->product_id }}">

                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}"
                                    id="wishlist_producturl{{ $product->product_id }}">

                                    <img src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                                        id="wishlist_productimage{{ $product->product_id }}" alt="" />

                                    <h2>{{ number_format($product->product_price) . '  ' . '$' }}</h2>

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
                            <li>
                                <a style="cursor: pointer;" onclick="add_compare({{ $product->product_id }}) ">
                                    <i class="fa fa-plus-square"></i>So sánh
                                </a>
                            </li>

                            <div class="container">
                                <!-- Modal -->
                                <div class="modal fade" id="sosanh" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">
                                                    <span id="title-compare"></span>
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <div id="row_compare"></div> --}}
                                                <table class="table table-hover" id="row_compare">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Giá</th>
                                                            <th>Hình ảnh</th>
                                                            <th>Thông số kĩ thuật</th>
                                                            <th>Xem sản phẩm</th>
                                                            <th>Xóa so sánh</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
