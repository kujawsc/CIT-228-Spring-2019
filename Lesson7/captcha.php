<?php 
//Set the image width and height 
$width = 75; 
$height = 30; 

//Create the image resource that the number string will display on
$image = imagecreate($width, $height); 
//Generate a totally random string using md5 
$md5 = md5(rand(0,999)); 

//We don't need a 32 character long string so we trim it down to 5 
$pass = substr($md5, 10, 5); 

//We are making three colors, white, black and gray 
$white = imagecolorallocate($image, 255, 255, 255); 
$black = imagecolorallocate($image, 0, 0, 0); 
$grey = imagecolorallocate($image, 204, 204, 204); 

//Make the background white 
imagefill($image, 0, 0, $white); 

//Add randomly generated string in black to the image
imagestring($image, 10, 20, 8, $pass, $black); 

//Throw in some grey lines to make it a little bit harder for any bots to break 
imagerectangle($image,0,0,$width-1,$height-1,$grey); 
imageline($image, 0, $height/4, $width, $height/4, $grey); 
imageline($image, $width/4, 0, $width/4, $height, $grey); 
imageline($image, 0, $height/2, $width, $height/2, $grey); 
imageline($image, $width/2, 0, $width/2, $height, $grey); 

//Tell the browser what kind of file has come in 
header("Content-Type: image/jpeg"); 

//Output the newly created image in jpeg format 
imageJpeg($image); 

//Free up resources
imagedestroy($image); 
?>