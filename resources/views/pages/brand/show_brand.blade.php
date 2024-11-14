@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->

                        @foreach($brand_name as $key => $name)
                       
                        <h2 class="title text-center">{{$name->brand_name}}</h2>

                        @endforeach
                        {{-- Sắp xếp  --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="sort">Sắp xếp theo</label>
                                <form action="" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <select name="sort" id="sort" class="form-control">
                                            <option value="tang_dan">Giá tăng dần</option>
                                            <option value="giam_dan">Giá giảm dần</option>
                                            <option value="kytu_az">A đến Z</option>
                                            <option value="kytu_za">Z đến A</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Áp dụng</button>
                                </form>
                            </div>
                        </div>

                        @foreach($brand_by_id as $key => $product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                        <div class="col-sm-6">
                            <div class="product-image-wrapper">
                           
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                            <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}"  id="wishlist_productname{{ $product->product_id }}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}" id="wishlist_productimage{{ $product->product_id }}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}" id="wishlist_productprice{{ $product->product_id }}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" id="wishlist_producturl{{ $product->product_id }}">>
                                                <img src="{{URL::to('uploads/product/'.$product->product_image)}}" alt="" id="wishlist_productimage{{ $product->product_id }}"/>
                                                <h2>{{number_format($product->product_price,0,',','.').' '.'$'}}</h2>
                                                <p>{{$product->product_name}}</p>

                                             
                                             </a>
                                             
                                            <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                                            </form>

                                        </div>
                                      
                                </div>
                           
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#" ><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                    
                        </div>
                        </a>
                        @endforeach
                    </div><!--features_items-->

        <!--/recommended_items-->
@endsection