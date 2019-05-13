@extends('public/base')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    php的小窝
                </h3>

                @foreach($blogs as $blog)
                    <div class="blog-post">
                        <h2 class="blog-post-title"><a href="{{ url('blog/detail/'.$blog['id']) }}">{{ $blog['title'] }}</a></h2>
                        <p class="blog-post-meta">{{ $blog['created_at'] }}</p>

                        <p>{{ mb_substr($blog['info'],0,120).'。。。' }}</p>
                        <span class="badge">分类</span>
                        <span class="badge badge-pill badge-success">{{ $blog['name'] }}</span>
                        <span class="badge">阅读量</span>
                        <span class="badge badge-pill badge-danger">{{ $blog['reading_volume'] }}</span>

                        <a href="#">
                            <span class="badge">作者</span>
                            <span class="badge badge-pill badge-info">{{ $blog['username'] }}</span>
                        </a>
                    </div>
                @endforeach
            </div><!-- /.blog-main -->

            @include('public/reight')

        </div><!-- /.row -->

    </main>

@endsection
