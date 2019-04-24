<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>dj-a</title>
		<link rel="stylesheet" type="text/css" href="{{ url('login-home/css/detailsmusic.css') }}" />

	</head>

	<body>
		<div class="music-lgin">

			<div class="music-lgin-all">
				<!--左手-->
				<div class="music-lgin-left ovhd">
					<div class="music-hand">
						<div class="music-lgin-hara"></div>
						<div class="music-lgin-hars"></div>
					</div>
				</div>

				<!--脑袋-->
				<div class="music-lgin-dh">
					<div class="music-lgin-alls">
						<div class="music-lgin-eyeleft">
							<div class="music-left-eyeball yeball-l"></div>
						</div>
						<div class="music-lgin-eyeright">
							<div class="music-right-eyeball yeball-r"></div>
						</div>
						<div class="music-lgin-cl"></div>
					</div>
					<!--鼻子-->
					<div class="music-nose"></div>
					<!--嘴-->
					<div class="music-mouth music-mouth-ds"></div>
					<!--肩-->
					<div class="music-shoulder-l">
						<div class="music-shoulder"></div>
					</div>
					<div class="music-shoulder-r">
						<div class="music-shoulder"></div>
					</div>
					<!--消息框-->
					<div class="music-news">LiYi！</div>
				</div>

				<!--右手-->
				<div class="music-lgin-right ovhd">
					<div class="music-hand">
						<div class="music-lgin-hara"></div>
						<div class="music-lgin-hars"></div>
					</div>
				</div>

			</div>

			<!--1-->
			<div class="music-lgin-text">
				<input class="inputname inputs" type="text" placeholder="用户名" value="{{ old('email') }}"/>
				@if ($errors->has('email'))
					<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
                    </span>
				@endif
			</div>
			<!--2-->
			<div class="music-lgin-text">
				<input type="password" class="mima inputs" placeholder="密码" />
				@if ($errors->has('password'))
					<span class="help-block">
                      	<strong>{{ $errors->first('password') }}</strong>
                	</span>
				@endif
			</div>
			<!--3-->
			<div class="music-lgin-text">
				<input class="music-qd inputs" type="button" value="确定" />
			</div>
			<input type="hidden" name="_token" value="{{ csrf_field() }}">
		</div>

		<script src="{{ url('login-home/js/jquery-1.9.1.min.js') }}"></script>
		<script type="text/javascript">
			//眼睛 密码部分
			$(".mima").focus(function() {
				$(".music-lgin-left").addClass("left-dh").removeClass("rmleft-dh");
				$(".music-lgin-right").addClass("right-dh").removeClass("right-rmdh");
				$(".music-hand").addClass("no");
			}).blur(function() {
				$(".music-lgin-left").removeClass("left-dh").addClass("rmleft-dh");
				$(".music-lgin-right").removeClass("right-dh").addClass("right-rmdh");
				$(".music-hand").removeClass("no");

			})
			//点击小人出来
			$(".inputname").focus(function() {
				$(".music-lgin-all").addClass("block");
				$(".music-news").addClass("no")
			})
			//点击小人消失

			//          $(".music-qd").focus(function(){
			//          	$(".music-lgin-all").removeClass("block")
			//          })


			//注册正则 简单判断

            $('.music-qd').click(function(){
                if(($('.inputname').val()=='')){
                    $(".music-news").html("请输入名称")
                }else if(($('.mima').val()=='')){
                	 $(".music-news").html("请输入密码")
                    $(".music-news").addClass("block")
                }else{
                	$.ajax({
						url:"{{ url('') }}",
						type:'post',
						dataType:'json',
						data:{},
						success:function(res){
						    console.log(res)
						},
						error:function(e){
						    console.log(e)
						}
					});
                }
            })
		</script>

	</body>

</html>
