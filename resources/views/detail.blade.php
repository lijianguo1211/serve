@extends('public/base')

@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    php的小窝
                </h3>

                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $details['title'] }}</h2>
                    <p class="blog-post-meta">{{ $details['create_at'] }} <a href="#">{{ $details['username'] }}</a></p>

                    <?php echo $details['content_md'] ?>
                    @if(!empty($comments))
                        <div class="card">
                            <div class="card-header">
                                <span>发言:</span>
                            </div>
                            <div id="liyi"></div>
                            @foreach($comments as $item)
                                <div class="body">
                                    <p class="card-text">
                                        {{ $item['content'] }}
                                        <span class="badge badge-pill badge-danger">{{ $item['username'] }}</span>
                                        ----
                                        <span>{{ date('Y-m-d H:i:s',$item['created_at']) }}</span>
                                    </p>

                                    <a href="#demo{{ $item['id'] }}" class="badge badge-pill badge-success" id="getMany" data-toggle="collapse">查看更多</a>
                                    <div id="demo{{ $item['id'] }}" class="collapse">
                                        <p class="card-text">
                                            <div id="lier">

                                            </div>
                                        </p>
                                    </div>

                                    <input type="hidden" id="luser_id" value="{{ $item['floor_user_id'] }}">
                                    <input type="hidden" id="cuser_id" value="{{ $item['layer_user_id'] }}">
                                </div>
                            @endforeach
                        </div>
                        <div style="padding-bottom: 20px"></div>
                    @endif

                </div>
            </div><!-- /.blog-main -->

            @include('public/reight')



        </div><!-- /.row -->
        <div id="liyi_alert"></div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">评论：</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" name="content" id="content" cols="30" rows="5"></textarea>
                    </div>
                    <a class="btn btn-primary" id="onSubmit">Submit</a>
                </form>
            </div>
            <div class="card-footer bg-dark text-white">
                <div id="div3"></div>
                <input type="hidden" name="_token" class="tag_token" value="<?php echo csrf_token(); ?>">
            </div>
        </div>
        <div style="padding-bottom: 20px"></div>
    </main>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $("#onSubmit").click(function(){
                var content = $("#content").val();
                @guest()
                    $("#liyi_alert").html("<div class=\"alert alert-success\"><a href=\"#\" rel=\"external nofollow\" rel=\"external nofollow\" rel=\"external nofollow\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</a><strong>评论失败！</strong>请你先登录哦！</div>");
                @else
                var l_users_id = "{{ Auth::user()->id }}";
                var tag_token = $(".tag_token").val();
                $.ajax({
                    type:'post',
                    url:"{{ url('/ajaxComment/'.$details['id']) }}",
                    data:{content: content,l_user_id:l_users_id,'_token':tag_token},
                    dataType: 'json',
                    success:function(result){
                        console.log(result.info);
                        var user = result.data.user;
                        var time = result.data.time;
                        // alert(result.info);
                        $("#liyi").html("<div class=\"body\"><p>"+content+"</p><span class=\"badge badge-pill badge-danger\">"+user+"</span>----<span>"+time+"</span></div>");
                    },
                    error:function(e) {
                        console.log(e);
                    }
                });
                @endguest
            });

            $("#getMany").click(function(){
                var tag_token = $(".tag_token").val();
                var luser = $("#luser_id").val();
                var cuser = $("#cuser_id").val();
                $.ajax({
                   url:"{{ url('ajaxGetComment/'.$details['id']) }}",
                   type:'post',
                   data:{'luser_id':luser,'cuser_id':cuser,'_token':tag_token},
                   dataType:'json',
                   success:function(res){
                        console.log(res.data)
                        $.each(res.data,function(index,value){
                            console.log(value.username);
                            console.log(value.content);
                            $("#lier").html(value.content+"<span class=\"badge badge-pill badge-danger\">"+value.username+"</span>----<span>"+value.created_at+"</span>");
                        })
                   },
                   error:function(err) {
                       console.log(err)
                   }
                });
            });
        });

    </script>
@endsection
