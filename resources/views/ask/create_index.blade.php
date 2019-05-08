@extends('public/base')
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
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-4 col-md-4 offset-sm-4 col-sm-4 offset-4 col-4">
                <div class="card">
                    <div class="card-body bg-dark text-white">
                        <h5 class="card-title">发布问题</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8 offset-sm-2 col-sm-8 offset-2 col-8">
                <form>
                    <div class="form-group">
                        <label for="title">主题：</label>
                        <input type="text" class="form-control" id="title" aria-describedby="titleHelp"  placeholder="主题">
                        <small id="titleHelp" class="form-text text-muted">对于主题的精简归纳</small>
                    </div>
                    <div class="form-group">
                        <label for="label">标签：</label>
                        <input type="text" class="form-control" id="label" aria-describedby="labelHelp" placeholder="标签">
                        <small id="labelHelp" class="form-text text-muted">对主题的分类归纳</small>
                    </div>

                    <div class="form-group">
                        <label for="myEditor">内容：</label>
                        <div class="editor">
                            <textarea id='myEditor' name="content"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
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
