@extends('public/img_base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-8">
                {{--<div class="file-loading">
                    <input id="kv-explorer" type="file" multiple>
                </div>--}}
                <div class="file-loading">
                    <input id="liyi" class="file" type="file">
                    <input id="csrf_liyi" type="hidden" value="{{ csrf_token() }}">
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-4"></div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            var csrf = $("#csrf_liyi").val();
            $("#liyi").fileinput({
                uploadUrl:"{{ url('img/upload') }}",//上传图片url
                deleteUrl: "{{ url('img/delete') }}",//删除图片url
                uploadAsync:true,
                maxAjaxThreads:9,
                enableResumableUpload: true,
                theme: 'fas',
                showUpload: false, //是否显示上传按钮
                showCaption: false,//是否显示标题
                //browseClass: "btn btn-primary", //按钮样式
                enctype: 'multipart/form-data',
                resumableUploadOptions: {
                    // uncomment below if you wish to test the file for previous partial uploaded chunks
                    // to the server and resume uploads from that point afterwards
                    // testUrl: "http://localhost/test-upload.php"
                },
                uploadExtraData: {
                    'uploadToken': 'SOME-TOKEN', // for access control / security
                    '_token':csrf
                },
                maxFileCount: 5,
                allowedFileExtensions : ['jpg', 'jpeg' ,'png','gif'],//接收的文件后缀
                allowedFileTypes: ['image'],    // allow only images 上传文件类型只接受图片类型
                showCancel: true,
                initialPreviewAsData: true,
                overwriteInitial: false,
                // initialPreview: [],          // if you have previously uploaded preview files
                // initialPreviewConfig: [],    // if you have previously uploaded preview files
            }).on('fileuploaded', function(event, previewId, index, fileId) {
                console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
            }).on('fileuploaderror', function(event, data, msg) {
                console.log('File Upload Error', 'ID: ' + data.fileId + ', Thumb ID: ' + data.previewId);
            }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
                console.log('File Batch Uploaded', preview, config, tags, extraData);
            });
        });
    </script>
@endsection
