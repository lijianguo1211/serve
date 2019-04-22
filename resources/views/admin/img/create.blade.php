@extends('admin/layout/base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加热点图片</legend>
    </fieldset>
    <form class="layui-form" action="{{ url('/admin/image/inserts') }}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">主题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入主题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">内容描述</label>
            <div class="layui-input-block">
                <textarea name="content"  cols="50" rows="10" lay-verify="required"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
                <select name="label" lay-verify="required">
                    <option value="0">顶级分类</option>
                    @foreach($data as $v)
                        <option value="{{$v->id}}">{{str_repeat('--',$v->level)}}{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
            <legend>图片上传</legend>
        </fieldset>

            <div class="layui-input-inline uploadHeadImage">
                <label class="layui-form-label">图片</label>
                <div class="layui-upload-drag" id="headImg">
                    <i class="layui-icon"></i>
                    <p>点击上传图片，或将图片拖拽到此处</p>
                </div>
            </div>
            <div class="layui-input-inline">
                <div class="layui-upload-list">
                    <img class="layui-upload-img headImage" src="http://t.cn/RCzsdCq" id="demo1">
                    <p id="demoText"></p>
                </div>
            </div>

        {{--<div class="editor">
            <label class="layui-form-label">内容描述</label>
            <textarea id='myEditor' name="content_md"></textarea>
        </div>--}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" type="submit">立即提交</button>

                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
        <input type="hidden" id="img_h" name="img_path" value="">
        <input type="hidden" name="_token" class="tag_token" value="<?php echo csrf_token(); ?>">
        {{--{{csrf_field()}}--}}
    </form>


@endsection
@section('js')
    <script>
        layui.use(["jquery", "upload", "form", "layer", "element"], function () {
            var $ = layui.$,
                element = layui.element,
                layer = layui.layer,
                upload = layui.upload,
                form = layui.form;
            var tag_token = $(".tag_token").val();
            //拖拽上传
            var uploadInst = upload.render({
                elem: '#headImg'
                , url: "{{ url('admin/image/upload') }}"
                , method:'post'
                , data:{'_token':tag_token}
                , ext: 'jpg|png|gif|jpeg'
                , before: function (obj) {
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                , done: function (res) {
                    //如果上传失败
                    if (res.status != 200) {
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    //打印后台传回的地址: 把地址放入一个隐藏的input中, 和表单一起提交到后台, 此处略..
                    window.parent.uploadHeadImage(res.url);
                    var demoText = $('#demoText');
                    $('#img_h').attr('value',res.url);
                    demoText.html('<span style="color: #8f8f8f;">上传成功!!!</span>');
                }
                , error: function () {
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function () {
                        uploadInst.upload();
                    });
                }
            });
            element.init();
        });
    </script>
@endsection
