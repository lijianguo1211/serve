@extends('public/base')

@section('content')

<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">
            @foreach($blogs as $blog)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $blog['title'] }}</h2>
                    <p class="blog-post-meta">{{ $blog['create_at'] }} <a href="#">{{ $blog['username'] }}</a></p>

                    <p><a href="{{ url('details/'.$blog['id']) }}">{{ mb_substr($blog['content'],0,120).'。。。' }}</a></p>

                </div>
            @endforeach

        </div><!-- /.blog-main -->

        @include('public/reight')
        {{--right--}}

    </div><!-- /.row -->

</div><!-- /.container -->
@endsection
