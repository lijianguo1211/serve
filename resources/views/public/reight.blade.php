<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>友情提示</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
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
        <h4>飞机票</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">QQ</a></li>
            <li><a href="#">微博</a></li>
        </ol>
    </div>
</div>
