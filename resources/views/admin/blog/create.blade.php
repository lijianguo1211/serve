@extends('admin/layout/base')

@section('css')
    <link href="{{URL::asset('/editor-md/css/editormd.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/editor-md/examples/css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>添加博客</legend>
    </fieldset>
    <form class="layui-form" action="{{ url('/admin/blog/insert') }}" method="post">

        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入文章简介内容" class="layui-textarea" name="info"></textarea>
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

        <div id="test-editormd" name="post[post_content]">
            <textarea name="post[post_content]"></textarea>
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
    <script src="{{ URL::asset('/editor-md/examples/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/editor-md/editormd.js') }}"></script>
    <script src="{{ URL::asset('/editor-md/editormd.amd.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            var testEditor = editormd("test-editormd", {
                width: "90%",
                height: 850,
                syncScrolling : "single",
                path : "../../../../editor-md/lib/",
                markdown : 'LiYi',
                codeFold : true,
                saveHTMLToTextarea : true,
                searchReplace : true,
                htmlDecode : "style,script,iframe|on*",
                emoji : true,
                taskList : true,
                tocm            : true,         // Using [TOCM]
                tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                flowChart : true,             // 开启流程图支持，默认关闭
                sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "{{ url('/admin/blog/upload_image') }}",
                onload : function() {
                    console.log('onload', this);
                }
            });
        });
    </script>
@endsection

