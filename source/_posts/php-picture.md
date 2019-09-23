---
title: php picture
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-17 18:15:23
password:
summary:
tags:
categories:
---
## bing 每日一图url
http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1
http://cn.bing.com/HPImageArchive.aspx?idx=1&n=1 将要得到昨天的图片
http://cn.bing.com/HPImageArchive.aspx?idx=2&n=1 得到前天的图片
返回url格式
https://cn.bing.com/th?id=OHR.StokePero_ZH-CN5293082939_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp
我使用以下php代码部署的api地址
http://47.102.85.59:8000/api/bing/
```
<?php
    function showImg($img){ //for gd > 1.3
      $info = getimagesize($img);
      $imgExt = image_type_to_extension($info[2], false);
      $fun = "imagecreatefrom{$imgExt}";
      $imgInfo = $fun($img);         //imagecreatefrompng ( string $filename )
      //$mime = $info['mime'];
      $mime = image_type_to_mime_type(exif_imagetype($img)); //获取图片的 MIME 类型
      header('Content-Type:'.$mime);
      $quality = 100;
      if($imgExt == 'png')
        $quality = 9;   //输出质量,JPEG格式(0-100),PNG格式(0-9)
      $getImgInfo = "image{$imgExt}";
      $getImgInfo($imgInfo, null, $quality); //如: imagepng ( resource $image )
      imagedestroy($imgInfo);
    }

    $bingurl="http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1";
    $response=file_get_contents($bingurl);
    $response=json_decode($response,true);
    $imgurl="https://cn.bing.com".$response["images"]["0"]["url"];
    //$prueurl=explode('&',$imgurl)['0'];
    //copyright=$response["images"]["0"]["copyright"]
    showImg($imgurl);
?>
```
