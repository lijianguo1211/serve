<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('bootstrap-4.0.0/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('login-home/css/signin.css') }}" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="row">
        <form class="form-signin" method="post" action="{{ url('admin/login') }}">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">登录</h4>
                </div>
                <div class="card-body">
                    <label for="inputEmail" class="sr-only">用户名</label>
                    <input type="text" name="username" id="inputEmail" class="form-control" placeholder="username" required autofocus>
                </div>

                <div class="card-body">
                    <label for="inputPassword" class="sr-only">密码</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">
                        登录
                    </button>
                </div>

                <div class="card-footer">
                    <img src="{{ url('img/open-iconic/svg/sun.svg') }}" alt="icon name">
                    <span><a href="{{ $github }}">github</a></span>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

<script>

</script>
</html>
