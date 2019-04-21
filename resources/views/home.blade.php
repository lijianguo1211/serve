@extends('public/base')

@section('content')


<div class="container">

    @include('public/index_img')



    <div class="row">

        <div class="col-sm-8 blog-main">

            @foreach($blogs as $blog)
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="{{ url('details/'.$blog['id']) }}">{{ $blog['title'] }}</a></h2>
                    <p class="blog-post-meta">{{ $blog['created_at'] }}</p>

                    <p>{{ mb_substr($blog['info'],0,120).'。。。' }}</p>
                    <span class="badge">分类</span><span class="label label-info">{{ $blog['name'] }}</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <span class="badge">阅读量</span><span class="label label-info">{{ $blog['reading_volume'] }}</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="#"><span class="badge">作者</span><span class="label label-info">{{ $blog['username'] }}</span></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a href="#"><span class="badge">收藏</span></a>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                    </button>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                </div>
            @endforeach

        </div><!-- /.blog-main -->

        @include('public/reight')
        {{--right--}}

    </div><!-- /.row -->

</div><!-- /.container -->
@endsection
