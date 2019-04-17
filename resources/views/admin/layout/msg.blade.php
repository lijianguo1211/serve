@if ($errors->any())
    layer.msg("{{$errors->first()}}",{icon:2})
    {{--<div class="layui-card">
        @foreach ($errors->all() as $error)
        <div class="layui-card-header">
                {{ $error->first() }}
        </div>
        @endforeach
    </div>
    </div>--}}
@endif
@if (session('success'))
    <div class="am-alert am-alert-success">
        <div class="am-container">
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="am-alert am-alert-danger">
        <div class="am-container">
            {{ session('error') }}
        </div>
    </div>
@endif