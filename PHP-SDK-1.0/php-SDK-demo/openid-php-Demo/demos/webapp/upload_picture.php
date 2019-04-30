<?php

require_once('baiduapi.inc.php');

if ($user) {
	$apiClient = $baidu->getBaiduApiClientService();
	$pic_url = $_POST['pic_url'];
        $ret = $apiClient->upload('https://openapi.baidu.com/file/2.0/pic/pictures/upload', array('upload' => '@'.$pic_url));
        if ($ret) {
        	$url = $ret['picture_url']['big'];
        } else {
          // upload failed
        }
} else {
  // user not login, reload the parent page
}

?>
<!doctype html>
<html>
  <head>
  	<meta http-equiv="content-type" content="text/html;charset=utf-8">
  </head>
  <body>
    
    
    <script>
    <?php if (!$user): ?>
      // user not login, reload the parent page
      window.parent.location.reload();
      
    <?php elseif (!$url): ?>
      // upload failed
      window.parent.onUploadFailed('<?php echo BaiduUtils::errmsg(); ?>');
    
    <?php else: ?>
      // upload success
      window.parent.onUploadSuccess('<?php echo $url; ?>');
    <?php endif ?>
        
    </script>
    
  </body>
</html>
