<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>每日一句</h4>
        <p><em>{{ $reghtTops['title'] }}&nbsp&nbsp</em>{{ $reghtTops['content'] }}</p>
    </div>
    <div class="sidebar-module">
        <h4>发布日期</h4>
        @foreach($release as $item)
        <ol class="list-unstyled">
            <li><a href="{{ url('details/'.$item['id']) }}">{{ $item['title'] }} -- {{ $item['create_at'] }}</a></li>
        </ol>
        @endforeach
    </div>
    <div class="sidebar-module">
        <h4>推荐阅读</h4>
        <ol class="list-unstyled">
            <li><a href="#">盗将行</a></li>
            <li><a href="#">纸短情长</a></li>
            <li><a href="#">年少有为</a></li>
            <li><a href="#">一壶老酒</a></li>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>飞机票</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">QQ</a></li>
            <li><a href="#">微博</a></li>
        </ol>
    </div>
</div>
