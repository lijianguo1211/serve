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

                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign up</a></li>
                    @else
                        <li class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown">
                                    {{ Auth::user()->username }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">个人信息</a>
                                <a class="dropdown-item" href="{{ url('img/index') }}">上传图集</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
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
        @foreach($ask as $item)
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">{{ $item['title'] }}</h1>
            <p class="lead my-3">{{ $item['content'] }}</p>
            <p class="lead mb-0"><a href="{{ $item['url_path'] }}" class="text-white font-weight-bold">{{ $item['url_name'] }}</a></p>
        </div>
        @endforeach()
    </div>

    <div class="row mb-2">
        @foreach($result as $item)
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    {{--<strong class="d-inline-block mb-2 text-success">Design</strong>--}}
                    <h3 class="mb-0">
                        <a class="text-dark card-title" href="#">{{ $item['title'] }}</a>
                    </h3>
                    <div class="mb-1 text-muted"></div>
                    <p class="card-text mb-auto">{{ $item['content'] }}</p>
                    <a href="#">{{ $item['username'] }}</a>
                </div>
                <img class="img-thumbnail img-responsive card-img-right flex-auto d-none d-md-block" width="70%" src="{{ $item['image_path'] }}" alt="{{ $item['title'] }}">
            </div>
        </div>
        @endforeach
    </div>
</div>
