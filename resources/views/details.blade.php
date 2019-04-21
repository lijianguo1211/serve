@extends('public/base')

@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    php的小窝
                </h3>

                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $details['title'] }}</h2>
                    <p class="blog-post-meta">{{ $details['create_at'] }} <a href="#">{{ $details['username'] }}</a></p>

                    <?php echo $details['content_md'] ?>

                </div>

            </div><!-- /.blog-main -->

            @include('public/reight')

        </div><!-- /.row -->

    </main>
@endsection
