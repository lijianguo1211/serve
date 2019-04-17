<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link href="{{URL::asset('/editor-md/css/editormd.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/editor-md/examples/css/style.css')}}" rel="stylesheet">
</head>
<body>
<div id="test-editormd" name="post[post_content]">
    <textarea name="post[post_content]"></textarea>
</div>
</body>
<script src="{{ URL::asset('/editor-md/examples/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/editor-md/editormd.js') }}"></script>
<script src="{{ URL::asset('/editor-md/editormd.amd.js') }}"></script>

<script type="text/javascript">
    $(function() {
           var testEditor = editormd("test-editormd", {
                width: "90%",
                height: 850,
                syncScrolling : "single",
                path : "../../editor-md/lib/",
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
                imageUploadURL : "../examples/php/upload.php",
                onload : function() {
                    console.log('onload', this);
                }
            });
    });
</script>
</html>
