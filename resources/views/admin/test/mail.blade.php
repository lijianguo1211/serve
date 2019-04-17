<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>{{ $title }}</h2>
<img src="{{ $url }}" alt="">
<pre>
      从前的日色
        变得慢
      车 马 邮件
         都慢
    一生只够爱一个人
                --{{ $author }}
</pre>
{{--@component('mail::button', ['url' => $url, 'color' => 'green'])
    View Order
@endcomponent--}}
</body>
</html>