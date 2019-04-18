@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>查看具体标题</legend>
    </fieldset>
    <form class="layui-form" action="/admin/type" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required"  autocomplete="off" class="layui-input" readonly="readonly" value="{{$result['title']}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">URL</label>
            <div class="layui-input-block">
                <input type="text" name="url" required  lay-verify="required"  autocomplete="off" class="layui-input" readonly="readonly" value="{{$result['url']}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-block">
                <input type="text" name="type" required  lay-verify="required"  autocomplete="off" class="layui-input" readonly="readonly" value="{{$result['type']}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">优先级</label>
            <div class="layui-input-block">
                <input type="text" name="priority" required  lay-verify="required"  autocomplete="off" class="layui-input" readonly="readonly" value="{{$result['priority']}}">
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
