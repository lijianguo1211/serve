<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="{{ url('/') }}">花儿尊上</a>
            </div>
            <div class="col-4 text-center">
                {{--<a class="blog-header-logo text-dark" href="#">Large</a>--}}
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                </a>
                <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
            </div>
        </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach($header as $item)
                <a class="p-2 text-muted" href="{{ url($item['url']) }}">{{ $item['title'] }}</a>
            @endforeach
        </nav>
    </div>

    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
            <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
    </div>

    <div class="row mb-2">
        @foreach($result as $item)
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    {{--<strong class="d-inline-block mb-2 text-primary">{{ $item['name'] }}</strong>--}}
                    <h3 class="mb-0">
                        <a class="text-dark" href="#">{{ $item['title'] }}</a>
                    </h3>
                    {{--<div class="mb-1 text-muted">Nov 12</div>--}}
                    <p class="card-text mb-auto">{{ $item['content'] }}</p>
                    <a href="#">{{ $item['username'] }}</a>
                </div>
                <img class=" img-responsive card-img-right flex-auto d-none d-md-block" width="70%" src="{{ $item['image_path'] }}" alt="{{ $item['title'] }}">
            </div>
        </div>
        @endforeach
    </div>
</div>
