@extends('admin/layout/base')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加每日一语</legend>
    </fieldset>
    <form class="layui-form" action="{{ url('/admin/right_top/inserts') }}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">提示语</label>
            <div class="layui-input-block">
                <textarea name="content"  cols="50" rows="10" class="layui-input" lay-verify="required"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" type="submit">立即提交</button>

                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
        {{csrf_field()}}
    </form>


@endsection
@section('js')

@endsection
