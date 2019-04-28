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
    echo 'download no'."\n";
} else {
    echo 'download 出现了'."\n";
}


if (strpos($haystack2,$needle) === false) {
    echo 'operate/downloadApk no'."\n";
} else {
    echo 'operate/downloadApk 出现了'."\n";
}

/**
 * collect_target_id: "380cdfe063a6fbdd"
message_id: "8633760b00a0d3c4db94e150daf41c82"
mm_version: "3.2.3"
path: "/storage/emulated/0/tencent/MobileQQ/diskcache/Cache_7ff15fca200692c9"
type: "media"
 */
