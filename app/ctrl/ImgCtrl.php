<?php

namespace app\ctrl;

use core\lib\Model;

class ImgCtrl extends BaseController
{	
    public function tosmallim($const = 100, $width, $height, $image)
    {
        if ($width > $const) {
            $times = floor($width / $const);
            $smwidth = $const;
            $smheight = floor($height / $times);
            $im = imagecreatetruecolor($smwidth, $smheight);
            imagecopyresampled($im, $image, 0, 0, 0, 0, $smwidth, $smheight, $width, $height);
            return [$im, $smwidth, $smheight];
        }
        return [$image, $width, $height];
    }

    public function index(){        
        $imname = 'https://ms.meiyoufan.com/public/img/posts/896x428.png';
        //返回一图像标识符，代表了从给定的文件名取得的图像
        $image = ImageCreateFromPng($imname);
        //$im = ImageCreateFromJpeg($imname);
    
        $size = getimagesize($imname);
        $width = $size[0];
        $height = $size[1];
    
        list($image, $width, $height) = $this->tosmallim(100, $width, $height, $image);
        
        $arr = [];
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $rgb = ImageColorat($image, $j, $i);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $arr[] = floor(($r + $g + $b) / 3);
            }
        }
        $num = count(array_unique($arr));
        $str = '<span style="font-size: 8pt;
            letter-spacing: 4px;
            line-height: 8pt;
            font-weight: bold;display: block;
            font-family: monospace;
            white-space: pre;
            margin: 1em 0;">';
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $rgb = ImageColorat($image, $j, $i);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $str .= $this->tochars($r, $g, $b, $num);
            }
            $str .= '<br>';
        }
        echo $str . '</span>';
    }
}