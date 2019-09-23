
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

  if($_GET['folder']){
     $folder=$_GET['folder'];
  }else{
     $folder='/img/';
  }
  //存放图片文件的位置
  $path = $_SERVER['DOCUMENT_ROOT']."/".$folder;
  $files=array();
  if ($handle=opendir("$path")) {
      while(false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                if(substr($file,-3)=='gif' || substr($file,-3)=='jpg') $files[count($files)] = $file;
                }
      } // by www.jbxue.com
  }
  closedir($handle);

  $random=rand(0,count($files)-1);
  showImg($path/$files[$random]);
  // if(substr($files[$random],-3)=='gif') header("Content-type: image/gif");
  // elseif(substr($files[$random],-3)=='jpg') header("Content-type: image/jpeg");
  // readfile("$path/$files[$random]");

  // $suiji=array_rand($array);
?>
<!-- <img src="<?=$array[$suiji]?>"> -->
