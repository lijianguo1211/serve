@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>查看具体标题</legend>
    </fieldset>
    <form class="layui-form" action="{{ url('/admin/header/edits') }}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">显示头标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" value="{{ $result['title'] }}" required  lay-verify="required" placeholder="请输入头标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">头标题URL</label>
            <div class="layui-input-block">
                <input type="text" name="url" value="{{ $result['url'] }}" required  lay-verify="required" placeholder="请输入头标题URL" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">优先级输入</label>
            <div class="layui-input-block">
                <select name="priority" lay-verify="required">
                    @foreach($config as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">位置选择</label>
            <div class="layui-input-block">
                <select name="type" lay-verify="required">
                    <option value="0">header</option>
                    <option value="1">right</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" type="submit">立即提交</button>
                {{--lay-submit lay-filter="formDemo"--}}
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
