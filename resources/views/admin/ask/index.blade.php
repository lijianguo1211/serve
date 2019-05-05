@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加首页显示</legend>
    </fieldset>
    <form class="layui-form" action="{{ url('/admin/ask/insert') }}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">显示头标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入头标题" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">来自哪里</label>
            <div class="layui-input-block">
                <input type="text" name="url_name" required  lay-verify="required" placeholder="来自哪里" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">头标题URL</label>
            <div class="layui-input-block">
                <input type="text" name="url_path" required  lay-verify="required" placeholder="请输入头标题URL" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">内容描述</label>
            <div class="layui-input-block">
                <textarea name="content"  cols="50" rows="10" lay-verify="required"></textarea>
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

@endsection
