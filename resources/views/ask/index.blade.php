@extends('public/ask_base')

@section('ask_content')
    <div class="col-md-8">
        @foreach($askResult as $item)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ url('ask/details/'.$item['id']) }}">{{ $item['title'] }}</a></h5>
                    <div class="">
                        <span class="badge badge-pill badge-dark">用户：{{ $item['username'] }}</span>
                        <span class="badge badge-pill badge-danger">点击量：{{ $item['reading_value'] }}</span>
                        @foreach($item['label'] as $value)
                            <span class="badge badge-pill badge-dark">{{ $value }}</span>
                        @endforeach
                        <span class="badge badge-pill badge-secondary">时间：{{ $item['created_at'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-4">
        <div class="card flex-md-row mb-4 box-shadow h-md-500">
            <div class="card-body d-flex flex-column align-items-start">
                 <img class="card-img-top" src="{{ url('upload/hotspot/1.jpg') }}" alt="Card image cap">
                 <div class="card-body">
                      <h5 class="card-title">花儿尊上</h5>
                      <p class="card-text">你知道的，你不知道的，你想知道的，你想要怎么知道的，都在这里。</p>
                      <a href="{{ url('ask/create/index') }}" class="btn btn-primary">提问</a>
                 </div>
            </div>
        </div>
    </div>
@endsection
