@extends('layout')
@section('content')
    <div class="features_items">
        <div class="product-image-wrapper">
            @foreach ($post as $key => $p)
                <div class="single-products">
                    <h2 class="title text-center">{{ $p->post_title }}</h2>
                    <p class="post-desc text-center" style="text-align: left" >{{$p->post_desc }}</p>

                        <!-- Hình ảnh bài viết -->
                        <div class="post-image">
                            <img src="{{ URL::to('uploads/post/' . $p->post_image) }}" alt="Ảnh bài viết" class="img-fluid" style="width:90%;height90%" />
                            <br>
                        </div>
                        <br>

                        <!-- Nội dung bài viết -->
                        <div class="post-content">
                            {!! $p->post_content !!}
                        </div>
                        <div class="post-content">
                            {!! $p->post_meta_desc !!}
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection
