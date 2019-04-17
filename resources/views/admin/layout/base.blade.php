<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>测试</title>
    <link rel="stylesheet" href="{{URL::asset('/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/font-awesome/4.5.0/css/font-awesome.min.css')}}">
</head>
<style>
    .am-alert {
        margin: 0;
    }
    #valiTest {
        margin: 0;
    }
</style>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">

    @include('admin/layout/header')


    @include('admin/layout/left')



    <div class="layui-body">
        <!-- 内容主体区域 -->
        @include('admin/layout/msg')
        <div style="padding: 15px;">
            @yield('content')
        </div>
    </div>

   @include('admin/layout/footer')
</div>
<script src="{{URL::asset('/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('/layui/layui.js')}}"></script>
<script src="{{URL::asset('/layui/layui.all.js')}}"></script>
<script src="{{URL::asset('/layui/lay/modules/layer.js')}}"></script>
<script>
    //JavaScript代码区域
    layui.use('element', function(){
        var element = layui.element;

    });
    var layer = layui.layer;
            @if(session('msg'))
    var $msg = "{{session('msg')}}";
    var $status = "{{session('status')}}";
    if($status == 0) {
        layer.msg($msg,{icon:2});
    } else if($status == 1) {
        layer.msg($msg,{icon:1})
    } else {
        layer.msg($msg);
    }
    @endif
    $(function(){
        var hideFlash = function () {
            $(".am-alert").fadeOut("slow");
        }
        setTimeout(hideFlash, 4000);
    })
</script>
@yield('js')
</body>
</html>