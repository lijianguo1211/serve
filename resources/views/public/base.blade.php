
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>花儿尊上</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{URL::asset('/css/blog.css')}}" rel="stylesheet">

</head>

<body>

{{--header--}}
@include('public/header')

@yield('content')

@include('public/footer')
{{--foot--}}


<!-- Placed at the end of the document so the pages load faster -->
<script src="{{URL::asset('/bootstrap/dist/js/jquery.js')}}"></script>
<script src="{{URL::asset('/bootstrap/dist/js/bootstrap.js')}}"></script>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1277155952'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1277155952%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>
