<div class="layui-header">
    <div class="layui-logo">测试 test</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item"><a href="">控制台</a></li>
        <li class="layui-nav-item"><a href="">商品管理</a></li>
        <li class="layui-nav-item"><a href="">用户</a></li>
        <li class="layui-nav-item">
            <a href="javascript:;">其它系统</a>
            <dl class="layui-nav-child">
                <dd><a href="{{ url('admin/testEmail') }}">发送邮件</a></dd>
                <dd><a href="">邮件管理</a></dd>
                <dd><a href="">消息管理</a></dd>
                <dd><a href="">授权管理</a></dd>
            </dl>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                {{--<img src="" class="layui-nav-img">--}}
                {{ Session::get('admin') }}
            </a>
            <dl class="layui-nav-child">
                <dd><a href="">基本资料</a></dd>
                <dd><a href="">安全设置</a></dd>
                <dd><a onclick="imgFun()" href="javascript:void(0)">设置图像</a></dd>
                <dd><a href="{{ url('admin/logout') }}">退出</a></dd>
            </dl>
        </li>
        {{--<li class="layui-nav-item"><a href="">退了</a></li>--}}
    </ul>
</div>

<script>
   function imgFun() {
       //如果是iframe层
       layer.open({
           type: 2,
           title:'修改图像',
           content:"{{ url('admin/logoImg') }}", //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
           area: ['500px','600px'],
           btn: ['按钮一', '按钮二'],
           yes: function(index, layero){

           },
           btn2: function(index, layero){

           },
           cancel: function(){

           },
           btnAlign: 'c',
           anim: 1,
           maxmin:true,
           success: function(layero, index){
               console.log(layero, index);
           }
       });
   }


</script>