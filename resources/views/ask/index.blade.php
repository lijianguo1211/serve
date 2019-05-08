@extends('public/base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-8">
                <h1>展示</h1>
            </div>
            <div class="col-md-4 col-sm-4 col-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ url('upload/hotspot/1.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">花儿尊上</h5>
                        <p class="card-text">你知道的，你不知道的，你想知道的，你想要怎么知道的，都在这里。</p>
                        <a href="{{ url('ask/create/index') }}" class="btn btn-primary">提问</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
