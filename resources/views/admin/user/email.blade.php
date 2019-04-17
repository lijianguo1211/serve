@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>邮件测试</legend>
    </fieldset>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">邮件地址</label>
            <div class="layui-input-block">
                <input type="email" name="address" id="address" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮件主题</label>
            <div class="layui-input-block">
                <input type="text" name="subject" id="subject" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">邮件内容</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" class="layui-textarea" name="content" id="content"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <a class="layui-btn" id="btns">立即提交</a>
            </div>
        </div>
        @csrf
    </form>

@endsection
@section('js')
    <script>
        $(function(){
            $("#btns").click(function(){
                $.ajax({
                    url:"{{ url('admin/passwordRetrieve') }}",
                    type:"post",
                    data:$("form").serialize(),
                    dataType:"json",
                    success:function(res) {
                        console.log(res);
                        if(res.status == 0) {
                            layer.msg(res.msg,{icon:2})
                        } else {
                            layer.msg(res.msg,{icon:1})
                            /* //location.href = "";*/
                        }
                    }
                });
            });
        });
    </script>

@endsection