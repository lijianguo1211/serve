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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">评论：</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="card-footer bg-dark text-white">

            </div>
        </div>
        <div style="padding-bottom: 20px"></div>
    </main>

@endsection
