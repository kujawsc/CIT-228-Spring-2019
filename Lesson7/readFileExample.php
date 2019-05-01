<html>
<head>
<title>Displaying contents of Extreme Adventure File</title>
</head>
<body>
<?php
$file = 'extremeAdventures.txt';
if( file_exists($file)){
$handle = fopen($file, 'r');
if( $file == false ){
    echo ( "Error in opening file" );
    exit();
}
else {
$data = fread($handle,filesize($file));
echo ( "File size : " . filesize($file) . " bytes" );
echo ( "<pre>$data</pre>" );
fclose($handle);
}
}
else
echo "The file does not exist";
?>
</body>
</html>