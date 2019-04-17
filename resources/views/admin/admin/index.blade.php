<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login Form Template</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{URL::asset('/login/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/login/assets/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/login/assets/css/form-elements.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/login/assets/css/style.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{URL::asset('/login/assets/ico/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::asset('/login/assets/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL::asset('/login/assets/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::asset('/login/assets/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::asset('/login/assets/ico/apple-touch-icon-57-precomposed.png')}}">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>Admin</strong> test form</h1>
                    <div class="description">
                        <p>
                            有一天，你辉煌了，一定要有个好身体，才能享受人生 ，有一天，你落魄了，还得有个好身体，才能东山再起！ <a href="#"><strong>Admin</strong></a>开始吧!
                        </p>
                    </div>
                </div>
            </div>
            @include('admin/layout/msg')
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Register</h3>
                            <p>Love is not a maybe thing. You know when you love someone</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-key"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form action="{{ url('admin/registerAdmin') }}" method="post" class="login-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-username">Username</label>
                                <input type="text" name="form-username" placeholder="用户名.手机号.邮箱..." class="form-username form-control" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Password</label>
                                <input type="password" name="form-password" placeholder="密码..." class="form-password form-control" id="form-password">
                            </div>
                            @csrf
                            <input type="submit" class="btn" value="登录">
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 social-login">
                    <h3>第三方登录:</h3>
                    <div class="social-login-buttons">
                        <a class="btn btn-link-1 btn-link-1-facebook" href="#">
                            <i class="fa fa-facebook"></i> GitHub
                        </a>
                        <a class="btn btn-link-1 btn-link-1-twitter" href="#">
                            <i class="fa fa-twitter"></i> QQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="copyrights">登录 <a title="TEST">测试</a></div>


<!-- Javascript -->
<script src="{{URL::asset('/login/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{URL::asset('/login/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('/login/assets/js/jquery.backstretch.min.js')}}"></script>
<script src="{{URL::asset('/login/assets/js/scripts.js')}}"></script>

<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->
<script>
    jQuery(document).ready(function() {
        $.backstretch("{{URL::asset('/login/assets/img/backgrounds/1.jpg')}}");
    })
</script>
</body>

</html>