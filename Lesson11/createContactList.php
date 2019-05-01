<?php
	//connect to server and select database; you may need it
	//$mysqli = mysqli_connect("localhost", "root", "", "testdb");
    $mysqli = mysqli_connect("localhost",  "lisabalbach_kujawsc", "CIT19020002",  "lisabalbach_Kujawski");
    //$mysqli = mysqli_connect("localhost", "root", "", "hlibrary");

	//if connection fails, stop script execution
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$get_master_library = "SELECT * FROM master_library";
	$get_master_res = mysqli_query($mysqli, $get_master_library) or die(mysqli_error($mysqli));

	$xml = "<bookinfo>";
	while($r = mysqli_fetch_array($get_master_res)){
	 $xml .= "<bookstitle>";
	 $xml .= "<id>".$r['id']."</id>";
	 $xml .= "<series>".$r['series']."</series>";  
 	 $xml .= "<ISBN>".$r['ISBN']."</ISBN>";
 	 $xml .= "<addDt>".$r['date_added']."</addDt>";  
  	 $xml .= "<modDt>".$r['date_modified']."</modDt>";    
     $xml .= "</bookstitle>";  
	}
$xml .= "</bookinfo>";
$sxe = new SimpleXMLElement($xml);
$sxe->asXML("contacts.xml");
echo "<div class='card text-center'><h1 class='card-header'>contacts.xml has been created</h1><br/>";
echo "<p><a href='viewContacts.php'>[View Contact List]</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Books Information</title>
  <meta name="author" content="Catherine Kujawski">
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
</body>
</html>