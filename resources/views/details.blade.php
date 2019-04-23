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

                </div>
            </div><!-- /.blog-main -->

            @include('public/reight')



        </div><!-- /.row -->
        @if(!empty($comments))
            <div class="card">
                @foreach($comments as $item)
                    <div class="body">
                        <span class="badge badge-pill badge-danger">{{ $item['username'] }}</span>----<span>{{ date('Y-m-d H:i:s',$item['created_at']) }}</span>
                        <p>{{ $item['content'] }}</p>
                    </div>
                @endforeach
            </div>
            <div style="padding-bottom: 20px"></div>
        @endif
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
        $("#onSubmit").click(function(){
            var content = $("#content").val();
            var l_users_id = 2;
            var tag_token = $(".tag_token").val();
            $.ajax({
                type:'post',
                url:"{{ url('/ajaxComment/'.$details['id']) }}",
                data:{content: content,l_user_id:l_users_id,'_token':tag_token},
                dataType: 'json',
                success:function(result){
                    console.log(result.info);
                    alert(result.info);
                },
                error:function(e) {
                    console.log(e);
                }
            });
        });
    </script>
@endsection
