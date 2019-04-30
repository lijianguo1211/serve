<?php

require_once('baiduapi.inc.php');
$apiClient = $baidu->getBaiduApiClientService();
$word = $_POST['translate'];
$ret = $apiClient->api('http://openapi.baidu.com/public/2.0/bmt/translate', array('from' => 'zh', 'to' => 'en', 'q' => $word));

?>
<!doctype html>
<html>
  <head>
  	<meta http-equiv="content-type" content="text/html;charset=utf-8">
  </head>
  <body>
    <script>
      window.parent.onTranslate(<?php echo $ret ? "true" : "false"; ?>, <?php echo $ret ? json_encode($ret) : BaiduUtils::errmsg(); ?>);
    </script>
    
  </body>
</html>
