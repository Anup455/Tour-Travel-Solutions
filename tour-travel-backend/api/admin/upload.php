<?php
require_once __DIR__.'/../../middleware/bootstrap.php';require_admin();
if($_SERVER['REQUEST_METHOD']!=='POST'||empty($_FILES['image']))json_out(['message'=>'Choose an image to upload.'],422);
$file=$_FILES['image'];if($file['error']!==UPLOAD_ERR_OK||$file['size']>5*1024*1024)json_out(['message'=>'Upload failed or image exceeds 5 MB.'],422);
$info=@getimagesize($file['tmp_name']);$types=[IMAGETYPE_JPEG=>'jpg',IMAGETYPE_PNG=>'png',IMAGETYPE_WEBP=>'webp'];if(!$info||!isset($types[$info[2]]))json_out(['message'=>'Only JPEG, PNG and WebP images are supported.'],422);
$dir=__DIR__.'/../../uploads';if(!is_dir($dir)&&!mkdir($dir,0755,true))json_out(['message'=>'Upload folder is unavailable.'],500);$filename=bin2hex(random_bytes(16)).'.'.$types[$info[2]];if(!move_uploaded_file($file['tmp_name'],$dir.'/'.$filename))json_out(['message'=>'Could not store the uploaded image.'],500);
$https=!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off';$base=dirname(dirname(dirname($_SERVER['SCRIPT_NAME'])));$url=($https?'https':'http').'://'.$_SERVER['HTTP_HOST'].$base.'/uploads/'.$filename;json_out(['image'=>$url],201);
