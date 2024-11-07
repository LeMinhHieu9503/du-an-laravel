@extends('layout')
@section('content')
    <div class="features_items">
        <h2 class="title text-center">Danh mục bài viết</h2>
        <div class="product-image-wrapper">
            @foreach ($post as $key => $p)
                <div class="single-products">
                    <div class="product-item">
                        <a href="{{ URL::to('/bai-viet/' . $p->post_id) }}">
                            <img src="{{ URL::to('uploads/post/' . $p->post_image) }}" alt="Ảnh bài viết"
                                class="product-image" />
                        </a>
                        <div class="product-info">
                            <a href="{{ URL::to('/bai-viet/' . $p->post_id) }}">
                                <h4>{{ $p->post_title }}</h4>
                                <p>{{ $p->post_desc }}</p>
                            </a>
                            {{-- <a href="" class="btn btn-warning btn-sm">Xem bài viết</a> --}}
                        </div>
                        <a href="" class="btn btn-warning btn-sm">Xem bài viết</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
