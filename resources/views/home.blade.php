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
                    <h2 class="blog-post-title"><a href="{{ url('details/'.$blog['id']) }}">{{ $blog['title'] }}</a></h2>
                    <p class="blog-post-meta">{{ $blog['created_at'] }} <a href="#">{{ $blog['username'] }}</a></p>

                    <p>{{ mb_substr($blog['info'],0,120).'。。。' }}</p>

                </div>
            @endforeach

        </div><!-- /.blog-main -->

        @include('public/reight')
        {{--right--}}

    </div><!-- /.row -->

</div><!-- /.container -->
@endsection
