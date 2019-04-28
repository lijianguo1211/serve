<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/28
 * Time: 13:49
 */
$haystack = 'device/fileDownload';
$haystack1 = 'download';
$haystack2 = 'operate/downloadApk';
$needle = 'download';

if (stripos($haystack,$needle) === false) {
    echo 'deice/fileDownload no'."\n";
} else {
    echo 'deice/fileDownload 出现了'."\n";
}

if (strpos($haystack1,$needle) === false) {
    echo 'not appear'."\n";
} else {
    echo 'download 出现了'."\n";
}


if (strpos($haystack2,$needle) === false) {
    echo 'operate/downloadApk no'."\n";
} else {
    echo 'operate/downloadApk 出现了'."\n";
}
