<?php
// When user finish authorization, request will redirect to this page,
// then all we need to do is to get access token by authorization code,
// and then notify its parent page

require_once('baiduapi.inc.php');

if ($user) {
	$apiClient = $baidu->getBaiduApiClientService();
	$profile = $apiClient->api('/rest/2.0/passport/users/getInfo', 
				   array('fields' => 'userid,username,sex,birthday'));
	if ($profile === false) {
		//get user profile failed
		var_dump(var_export(array('errcode' => $baidu->errcode(), 'errmsg' => $baidu->errmsg()), true));
		$user = null;
	}
}

?>

<!doctype html>
<html>
  <head>
  	<meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>website demo</title>
    <link rel="stylesheet" type="text/css" href="../css/LightFace.css"></>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
  	<div align="center">
          <?php if($user): ?>
          <p>登录成功！当前登录用户是<?php echo $profile['username']; ?></p>
          <p>开发者可以在这个页面的服务端实现将百度账号与该站点的自有账号系统进行账号明绑或暗绑处理</p>
          <input type="button" id="confirm" name="confirm" value="我知道鸟~~" onclick="return callback();"/>
          <?php else: ?>
          <p>登录失败鸟~~~是不是没给同意授权啊？</p>
          <?php endif ?>
  	</div>
  	
    <script>
      function callback() {
        parent.onLoginSuccess();
        return false;
      }
    	
    </script>
  </body>
</html>