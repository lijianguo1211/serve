@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加头标题</legend>
    </fieldset>
    <form class="layui-form" action="/admin/type" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">分类标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入分类标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                <select name="pid" lay-verify="required">
                    <option value="0">顶级分类</option>
                    @foreach($types as $v)
                        <option value="{{$v->id}}">{{str_repeat('--',$v->level)}}{{$v->name}}</option>
                    @endforeach
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

@endsection
