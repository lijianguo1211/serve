<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{URL::asset('/layui/css/layui.css')}}">
</head>
<body>
<h1>登录</h1>
<form action="/admin/doLogin" method="post">
    <table>
        <tr>
            <td>用户名:</td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td>密码:</td>
            <td><input type="password" name="pwd"></td>
        </tr>
        <tr>
            <td>{{csrf_field()}}</td>
            <td><input type="submit" value="登录"></td>
        </tr>
    </table>
</form>
<script src="{{URL::asset('/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('/layui/layui.all.js')}}"></script>
<script src="{{URL::asset('/layui/layui.js')}}"></script>
<script src="{{URL::asset('/layui/lay/modules/layer.js')}}"></script>
<script type="text/javascript">
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
</script>
</body>
</html>
