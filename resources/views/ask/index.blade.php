@extends('public/ask_base')

@section('ask_content')
    <div class="col-md-8">
        @foreach($askResult as $item)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ url('ask/details/'.$item['id']) }}">{{ $item['title'] }}</a>
                        ----
                        <a href="#" class="badge badge-pill badge-dark">{{ $item['username'] }}</a>
                    </h5>
                    <div class="">
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
@section('content')
    <main role="main" class="container">
        <div class="row">
            <div style="padding-bottom: 100px"></div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{ url('js/lib/sockjs.js') }}"></script>
    <script src="{{ url('js/lib/stomp.js') }}"></script>

    <script>
        var ws = new SockJS('http://lglg.xyz:15671/stomp');
        var client = Stomp.over(ws);
        var id="71815464bba9cf3e";
        var msgId = ''
        client.connect('guest', 'guest', function () {

            client.subscribe("/topic/push_send_ad526e34e658132b", function (data) {
                var quote = JSON.parse(data.body);

                msgId = quote.messageid;
            });

        });

        function sendConnect(){
            var _param = {
                type:'connected',
                content:id
            }
            client.send("/topic/send_" + id, {}, JSON.stringify(_param));
        }

        function send(){
            var _param = {
                type:'command',
                messageid:msgId,
                content:'随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 随着浏览器性能提升，更多Web Page演变为Web App，特别是在中大型的项目中，就需要一个 '
            }
            client.send("/topic/send_" + id, {},JSON.stringify(_param));
        }

    </script>
@endsection
