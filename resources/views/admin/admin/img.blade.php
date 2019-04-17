<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>上传修改图片</title>
    <link rel="stylesheet" href="{{URL::asset('/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/font-awesome/4.5.0/css/font-awesome.min.css')}}">
</head>
<style>

</style>
<body class="layui-layout-body">
<div style="width: 300px;height: 300px;">

</div>

<div class="layui-upload-drag" id="test10">
    <i class="layui-icon"></i>
    <p>上传图片</p>
</div>

<script src="{{URL::asset('/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('/layui/layui.js')}}"></script>
<script src="{{URL::asset('/layui/layui.all.js')}}"></script>
<script src="{{URL::asset('/layui/lay/modules/layer.js')}}"></script>
<script>
    layui.use('upload', function() {
        var $ = layui.jquery
            , upload = layui.upload;
        upload.render({
            elem: '#test10'
            , url: '/upload/'
            , done: function (res) {
                console.log(res)
            }
        })
    })

</script>
</body>
</html>