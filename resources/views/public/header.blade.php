<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            @foreach($header as $item)
                <a class="blog-nav-item" href="{{ url($item['url']) }}">{{ $item['title'] }}</a>
            @endforeach
            <a class="blog-nav-item" href="{{ url('testMd') }}">编辑</a>
        </nav>
    </div>
</div>
