<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/29
 * Time: 19:03
 */
include_once('simple_html_dom.php');
ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
ini_set('max_execution_time', '0');
ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 5.00; Windows 98)');
$base = 'https://www.bodekang.com/69_69136/';
$start = '18625490.html';

$next = $start;
$file_name = __DIR__.'\LiYi.txt';
if(!file_exists($file_name)) {
    touch($file_name);
}

while($next) {
    echo 'getting ' . $next . PHP_EOL;
    //$result = file_get_contents($base . $next);
    $html =file_get_html($base . $start);
    $div = $html->find('[id="content"]');
    foreach ($div as $k => $v) {
        $line = str_replace("<br />", "\n", $v);
        $line = str_replace(" ", '', $line);
        $line = str_replace("&nbsp;", '', $line);
        file_put_contents($file_name,$line,FILE_APPEND);
    }
    $div2 = $html->find('[class=bottem2]');
    $div2->dump();

}
