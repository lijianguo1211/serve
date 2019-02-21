<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/14
 * Time: 10:19
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class CreateImageController
{
    private $param;

    private $size;//宽高

    private $format;//图片格式

    private $color;//二维码颜色

    private $brckgroundcolor;//二维码背景颜色

    private $errorCorrection;//容错级别

    private $encoding;//编码格式

    private $margin;

    public function __construct(Request $request)
    {
        $this->param = $request;
    }

    public function test()
    {
        return view('api/create_image/test');
    }

    public function isValidata()
    {
        if (!$this->param->has('size')) {
            $this->size = 300;
        } else {
            $this->size = $this->param->get('size');
        }

        if (!$this->param->has('format')) {
            $this->format = 'png';
        } else {
            $this->format = $this->param->get('format');
        }

        if (!$this->param->has('color')) {
            $this->color = '0,0,0';
        } else {
            $this->color = $this->param->get('color');
        }

        if (!$this->param->has('brckgroundcolor')) {
            $this->brckgroundcolor = '255,255,255';
        } else {
            $this->brckgroundcolor = $this->param->get('brckgroundcolor');
        }

        if (!$this->param->has('errorCorrection')) {
            $this->errorCorrection = 'H';
        } else {
            $this->errorCorrection = $this->param->get('errorCorrection');
        }

        if (!$this->param->has('encoding')) {
            $this->encoding = 'UTF-8';
        } else {
            $this->encoding = $this->param->get('encoding');
        }

        if (!$this->param->has('margin')) {
            $this->margin = 5;
        } else {
            $this->margin = $this->param->get('margin');
        }
    }

    public function getColor()
    {
        if (!strpos($this->color,',')) {
            //使用默认值
            $this->color = '255,255,255';
        }

        if (!strpos($this->brckgroundcolor,',')) {
            //使用默认值
            $this->color = '0,0,0';
        }

        $tmpColor = $this->color;
        $tmpBgColor = $this->brckgroundcolor;
        $tmpColorArray = explode(',',$tmpColor);
        $tmpBgColorArray = explode(',',$tmpBgColor);
        $colorCount = count($tmpColorArray);
        $bgColorCount = count($tmpBgColorArray);

        if ($colorCount < 3 || $bgColorCount < 3) {
            return false;
        }

        return ['color' => $tmpColorArray,'bgColor' => $tmpBgColorArray];
    }

    public function createImage()
    {
        $imageUrl = $url = 'http://' . config('img.img_download', $this->param->getHost());
        $logoUrl = public_path('img/1.png');
        $this->isValidata();
        $result = (new BaconQrCodeGenerator())
           ->format($this->format)->size($this->size);
        if ($this->getColor() !== false) {
            $getColorArr = $this->getColor();
            $color = $getColorArr['color'];
            $bgColor = $getColorArr['bgColor'];
            $result = $result->color($color[0],$color[1],$color[2])->backgroundColor($bgColor[0],$bgColor[1],$bgColor[2]);
        }

        $result = $result->errorCorrection($this->errorCorrection)
                         ->encoding($this->encoding);
        if (!empty($logoUrl)) {
            $logoType = $this->param->get('logoType');
            switch ($logoType) {
                case 1:
                    $percentage = .15;
                    $absolute = false;
                    break;
                case 2:
                    $percentage = .15;
                    $absolute = false;
                    break;
                case 3:
                    $percentage = .15;
                    $absolute = true;
                    break;
                default :
                    $percentage = .2;
                    $absolute = false;
                    break;

            }
            $result = $result->merge($logoUrl,$percentage,$absolute);
        }

        $path = uniqid('LiYi_',true);
        if (!is_dir(public_path('qrcode'))) {
            mkdir(public_path('qrcode'));
        }
        if (!is_dir(public_path('qrcode/img'))) {
            mkdir(public_path('qrcode/img'));
        }
        $result = $result->margin($this->margin)->generate($imageUrl,public_path('qrcode/img/'.$path.'.png'));

        var_dump($result);

        var_dump($imageUrl);

        var_dump($logoUrl);
    }


}
