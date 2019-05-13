<aside class="col-md-4 blog-sidebar">
    <div class="p-3 mb-3 bg-light rounded">
        <h4>每日一句</h4>
        <p><em>{{ $reghtTops['title'] }}&nbsp&nbsp</em>{{ $reghtTops['content'] }}</p>
    </div>

    <div class="p-3">
        <h4 class="font-italic">发布日期</h4>
        @foreach($release as $item)
            <ol class="list-unstyled mb-0">
                <li><a href="{{ url('blog/detail/'.$item['id']) }}">{{ $item['title'] }} -- {{ $item['created_at'] }}</a></li>
            </ol>
        @endforeach
    </div>

    <div class="p-3">
        <h4 class="font-italic">推荐阅读</h4>
        <ol class="list-unstyled">
            @foreach($value as $item)
                <li><a href="{{ url('blog/detail/'.$item['id']) }}">{{ $item['title'] }}</a></li>
            @endforeach
        </ol>
    </div>

    <div class="p-3">
        <h4 font-italic>飞机票</h4>
        <ol class="list-unstyled">
            @foreach($right as $item)
                <li><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
            @endforeach
        </ol>
    </div>
</aside>
