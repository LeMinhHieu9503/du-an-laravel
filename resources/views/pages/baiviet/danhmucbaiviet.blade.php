@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center">Danh mục bài viết</h2>
        <div class="product-image-wrapper">
            @foreach ($post as $key => $p)
                <div class="single-products">
                    <div class="product-item">
                        <img src="{{ URL::to('uploads/post/' . $p->post_image) }}" alt="Ảnh bài viết" class="product-image" />
                        <div class="product-info">
                            <h4 style="text-align: left">{{ $p->post_title }}</h4>
                            <p style="text-align: left" >{{ $p->post_desc }}</p>
                        </div>
                        <a href="{{url('bai-viet/'.$p->post_id)}}" class="btn btn-warning btn-sm">Xem bài viết</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
