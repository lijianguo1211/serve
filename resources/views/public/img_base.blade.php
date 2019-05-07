
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('img/ico/black_32px_1165127_easyicon.net.ico') }}">

    <title>花儿尊上</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('/bootstrap-4.0.0/dist/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('/css/fonts.googleapis.com.css') }}" rel="stylesheet">
    <link href="{{ url('/css/blog.css') }}" rel="stylesheet">
    <link href="{{ url('/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/css/use.fontawesome.com.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ url('/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
</head>

<body>

{{--header--}}
@include('public/img_header')

@yield('content')

@include('public/footer')
{{--foot--}}


<script src="{{ url('js/jquery-3.1.1.js') }}"></script>
<script>window.jQuery || document.write('<script src="{{ url('/bootstrap-4.0.0/assets/js/vendor/jquery-slim.min.js') }}"><\/script>')</script>
<script src="{{ url('/bootstrap-4.0.0/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ url('/bootstrap-4.0.0/dist/js/bootstrap.js') }}"></script>
<script src="{{ url('/bootstrap-4.0.0/assets/js/vendor/holder.min.js') }}"></script>
<script src="{{ url('/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ url('/js/plugins/piexif.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/locales/zh.js') }}" type="text/javascript"></script>
{{--<script src="{{ url('/js/locales/es.js') }}" type="text/javascript"></script>--}}
<script src="{{ url('/themes/fas/theme.js') }}.." type="text/javascript"></script>
{{--<script src="{{ url('/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>--}}
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
@yield('js')
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1277155952'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1277155952%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>
