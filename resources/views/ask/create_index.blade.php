@extends('public/ask_base')
@section('css')
    <link rel="stylesheet" href="http://cdn.bootcss.com/codemirror/4.10.0/codemirror.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/8.4/styles/default.min.css">
    <link rel="stylesheet" href="{{ asset('plugin/editor/css/pygment_trac.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/editor/css/editor.css') }}">
    <style>
        .editor{
            width:{{ config('editor.width') }};
        }
    </style>
@endsection
@section('ask_content')
    <div class="offset-md-1 col-md-11">
        <div class="alert alert-dark" role="alert">
           等待发布
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('ask/add') }}" method="post">
            <div class="form-group">
                <label for="title">主题：</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp"  placeholder="主题">
                <small id="titleHelp" class="form-text text-muted">对于主题的精简归纳</small>
            </div>
            <div class="form-group">
                <label for="label">标签：</label>
                <input type="text" name="label" class="form-control" id="label" aria-describedby="labelHelp" placeholder="标签，分类，多个之间用逗号隔开">
                <small id="labelHelp" class="form-text text-muted">对主题的分类归纳，多个之间用逗号隔开</small>
            </div>

            <div class="form-group">
                <label for="myEditor">内容：</label>
                <div class="editor">
                    <textarea id='myEditor' class="form-control" name="content"></textarea>
                </div>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-secondary btn-lg btn-block">Submit</button>
        </form>
    </div>
@endsection

@section('content')
    <main role="main" class="container">
        <div class="row">
           <div style="padding-bottom: 100px"></div>
        </div>
    </main>
@endsection

@section('js')
    <script src="http://cdn.bootcss.com/highlight.js/8.4/highlight.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.js"></script>
    <script src="http://cdn.bootcss.com/marked/0.3.2/marked.min.js"></script>
    <script type="text/javascript" src="http://cdn.bootcss.com/codemirror/4.10.0/codemirror.min.js"></script>
    <script type="text/javascript" src="http://cdn.bootcss.com/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
    <script type="text/javascript" src="{{ url('plugin/editor/js/highlight.js') }}"></script>
    <script type="text/javascript" src="{{ url('plugin/editor/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ url('plugin/editor/js/MIDI.js') }}"></script>
    <script type="text/javascript" src="{{ url('plugin/editor/js/fileupload.js') }}"></script>
    <script type="text/javascript" src="{{ url('plugin/editor/js/bacheditor.js') }}"></script>
    <script type="text/javascript" src="{{ url('plugin/editor/js/bootstrap3-typeahead.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            url = "{{ url(config('editor.uploadUrl')) }}";

            @if(config('editor.ajaxTopicSearchUrl',null))
                ajaxTopicSearchUrl = "{{ url(config('editor.ajaxTopicSearchUrl')) }}";
            @else
                ajaxTopicSearchUrl = null;
                    @endif

            var myEditor = new Editor(url,ajaxTopicSearchUrl);
            myEditor.render('#myEditor');
        });
    </script>
@endsection
