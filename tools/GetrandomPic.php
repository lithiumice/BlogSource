<?php

    function get_files($dir,&$files){
        $handler = opendir($dir);
        while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
            if ($filename != "." && $filename != "..") {
              $str="*.(jpg|png|jpeg|gif)";
              if(preg_match($filename,$str)){
                    $files[] = $filename ;
               }
             }
           }
           print_r($files)
           closedir($handler);
        }

    function get_allfiles($path,&$files) {
        if(is_dir($path)){
            $dp = dir($path);
            while ($file = $dp ->read()){
                if($file !="." && $file !=".."){
                    get_allfiles($path."/".$file, $files);
                }
            }
            $dp ->close();
        }
        if(is_file($path)){
            $files[] =  $path;
        }
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

    // $dir="../../../img"
    $files;
    $dir="/home/lithium/Pictures/wlop/"
    get_files($dir,$files);
    $id=mt_rand(0,count($files)-1);
    $imgname=$files[$id];
    showImg($imgname);

?>
