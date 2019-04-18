@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>修改每日一句</legend>
    </fieldset>
    <form class="layui-form" action="{{url('admin/right_top/edits/'.$result['id'])}}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">主题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入主题" autocomplete="off" class="layui-input" value="{{$result['title']}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
                <textarea name="content" lay-verify="required" cols="80" rows="10">{{$result['content']}}</textarea>

            </div>
        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" type="submit">立即提交</button>
                {{--lay-submit lay-filter="formDemo"--}}
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>


@endsection
@section('js')

@endsection
