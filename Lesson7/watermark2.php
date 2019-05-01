<?php

$source = "source";

$destination = "destination";

$watermark = imagecreateformpng("watermark.png");

$margin_right = 10;
$margin_bottom = 10;

$sx = imagesx($watermark);
$sy = imagesy($watermark);

$images = array_diff(scandir($source), array('..','.'));

foreach ($images as $images){
  $img = imagecreateformpng
}

?>