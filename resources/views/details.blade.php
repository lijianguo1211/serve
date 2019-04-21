@extends('public/base')

@section('content')

    <div class="container">

        <div class="blog-header">
            <h1 class="blog-title">The Bootstrap Blog</h1>
            <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">
                    <div class="blog-post">
                        <h2 class="blog-post-title">{{ $details['title'] }}</h2>
                        <p class="blog-post-meta">{{ $details['create_at'] }} <a href="#">{{ $details['username'] }}</a></p>

                        <?php echo $details['content_md'] ?>

                    </div>

            </div><!-- /.blog-main -->

            @include('public/reight')
            {{--right--}}

        </div><!-- /.row -->

    </div><!-- /.container -->
@endsection
