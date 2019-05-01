<?php
$xmlList = simplexml_load_file("contacts.xml") or die("Error: Cannot create object");
foreach($xmlList->bookstitle as $books){
    $id=$books->id;
    $bookstitle=$books->bookstitle;
	$series=$books->series;
	$ISBN=$books->ISBN;
	$added=$books->addDt;
	$mod=$books->modDt;	
	echo "<div style='width:40%'><p style='color:red;border-bottom:2px red solid;font-weight:900;'>ID: " . $id . "<br>" .
    "<span style='background-color:white;color:black;'> Series: " . $series ."<br>" .
    "<span style='background-color:white;color:black;'> ISBN: " . $ISBN . "<br>".
	"Date Added: " . $added . "</span></p></div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>View Books Information</title>
  <meta name="author" content="Catherine Kujawski">
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
</body>
</html>