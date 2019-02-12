<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/12
 * Time: 19:32
 */

class Reptile
{
    public static $aUrlArr = [];
    public function recursiveDownloadImages($captureUrl)
    {
        //没抓取过
        if (!in_array($captureUrl,self::$aUrlArr)) {
            //放入静态数组
            self::$aUrlArr[] = $captureUrl;
        } else {
        //抓取过，直接退出
            return;
        }

        //下载当前页面的所有图片
        $this->downloadCurrentPageImage($captureUrl);

        //@屏蔽所有错误输出
        $content = @file_put_contents($captureUrl);

        //正则表达式匹配a标签当中的href属性
        $imgPattern = "|<a[^>]+href=['\"]?([^'\"?]+)['\">]|U";
        preg_match_all($imgPattern,$content,$aOut,PREG_SET_ORDER);

        //定义一个数组，存放当前循环下抓取图片的超链接地址
        $tmpArr = [];

        foreach ($aOut as $k => $v) {

        }

        foreach ($tmpArr as $k => $v) {
            //超链接路径地址
            if (strpos($v,'http://') !== false || strpos($v,'https://')) {
                //如果URL当中包含http或者https，代表可以直接访问
                $aUrl = $v;
            } else {
                //这个代表是相对的地址，需要拼接以后才能访问
                $domainUrl = substr($captureUrl,0,strpos($captureUrl,'/',8)+1);
                $aUrl = $domainUrl.$v;
            }
            $this->recursiveDownloadImages($aUrl);
        }
    }

}
