@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加管理员</legend>
    </fieldset>

    <form class="layui-form" id="forms">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" id="user_name" name="user_name" placeholder="请输入用户名" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-input-block">
                <input type="text" id="user_account" name="user_account" placeholder="请输入账号" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
                <input type="text" id="user_nickname" name="user_nickname" placeholder="请输入昵称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">手机</label>
                <div class="layui-input-inline">
                    <input type="tel" id="user_phone" name="user_mobile" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                    <input type="text" id="user_email" name="user_email" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" id="user_pwd" name="user_pwd" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">重复密码</label>
            <div class="layui-input-block">
                <input type="password" id="user_rpwd" name="user_rpwd" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理选择</label>
            <div class="layui-input-block">
                <select name="user_type" id="user_type">
                    <option value=""></option>
                    <option value="1">超级管理员</option>
                    <option value="2">特级会员</option>
                    <option value="3">高级会员</option>
                    <option value="4">普通会员</option>
                    <option value="4">用户</option>
                </select>
            </div>
        </div>
        @csrf
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn" id="btns">立即注册</a>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(function(){
            $("#btns").click(function(){
                if($("#user_name").val() == '') {
                    layer.msg( '用户名不能为空', {icon: 2});
                }
                if($("#user_account").val() == '') {
                    layer.msg( '用户账户不能为空', {icon: 2});
                }
                if($("#user_nickname").val() == '') {
                    layer.msg( '用户昵称不能为空', {icon: 2});
                }
                if($("#user_phone").val() == '') {
                    layer.msg( '用户手机号不能为空', {icon: 2});
                }
                if($("#user_email").val() == '') {
                    layer.msg( '用户邮箱不能为空', {icon: 2});
                }
                if($("#user_pwd").val() == '') {
                    layer.msg( '用户密码不能为空', {icon: 2});
                }
                if($("#user_rpwd").val() == '') {
                    layer.msg( '用户再次输入密码不能为空', {icon: 2});
                }
                if($("#user_type").val() == '') {
                    layer.msg( '用户类型不能为空', {icon: 2});
                }
                if($("#user_pwd").val() != $("#user_rpwd").val()) {
                    layer.msg( '两次输入密码不一致', {icon: 2});
                }
                $.ajax({
                    url:"{{ url('admin/add_admin') }}",
                    type:"post",
                    data:$("#forms").serialize(),
                    success:function(res) {
                        //console.log(res);
                        var obj = JSON.parse(res);
                        console.log(obj);
                        if(obj.success == false) {
                            console.log(obj.errors);
                            $.each(obj.errors,function(key,value){
                                $.each(value,function(k,v){
                                    layer.msg(v,{icon:2})
                                })
                            })
                        }
                        if(obj.status == 0) {
                            layer.msg(obj.msg,{icon:2})
                        } else {
                            layer.msg(obj.msg,{icon:1})
                           /* //location.href = "";*/
                        }

                    }
                });
            });
        });
    </script>
@endsection
