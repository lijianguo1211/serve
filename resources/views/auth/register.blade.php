@extends('public/login_base')

@section('content')

<div class="container" style="margin-top:80px;">
        <div class="row">
            <div class="col-sm-4 col-md-7 col-lg-5">
                <div class="card" style="width:400px">
                    <div class="card-body">
                        <h4 class="card-title">花儿尊上</h4>
                        <p class="card-text">你来，我静静的看着你，你走，风雨无走，我送你</p>
                    </div>
                    <img class="card-img-bottom" src="http://lglg.xyz/upload/hotspot/hotspot_2019_04_22_20_42_15_5cbdb6a794bdb_0d6c9529c612671f2b1a698857db98b7.jpg" alt="Card image" style="width:100%">
                </div>
            </div>
            <div class="col-sm-8 col-md-5 col-lg-7">
                <form method="post" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">登录</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-6 control-label">用户名：</label>

                                <div class="col-md-7">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-6 control-label">邮箱：</label>

                                <div class="col-md-7">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-6 control-label">手机号：</label>

                                <div class="col-md-7">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-6 control-label">密码：</label>

                                <div class="col-md-7">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-6 control-label">确认密码：</label>

                                <div class="col-md-7">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        注册
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-9">
                                    <a class="btn btn-link" href="{{ route('github') }}">
                                        <img src="{{ url('img/ico/github_copyrighted_32px.ico') }}" alt="github登录">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
