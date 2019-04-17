@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>查看文章分类</legend>
    </fieldset>
    <form class="layui-form" action="/admin/type" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">分类标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入分类标题" autocomplete="off" class="layui-input" readonly="readonly" value="{{$type_list['name']}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">PID</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入分类标题" autocomplete="off" class="layui-input" readonly="readonly" value="{{$type_list['pid']}}">
            </div>
        </div>

        {{csrf_field()}}
    </form>


@endsection
@section('js')
    <script>
        // //Demo
        // layui.use('form', function(){
        //     var form = layui.form;
        //
        //     //监听提交
        //     form.on('submit(formDemo)', function(data){
        //         console.log(data);
        //         //layer.msg(JSON.stringify(data.field));
        //         //return false;
        //     });
        // });
    </script>
@endsection
