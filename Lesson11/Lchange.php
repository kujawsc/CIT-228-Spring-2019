<?php
session_start();
//connect to database
include 'Lconnect.php';

//time to update tables, so check for required fields
	if (($_POST['bookstitle'] == "") || ($_POST['series'] == "")) {
		header("Location: LchangeEntry.php");
		exit;
	}
	//connect to database
	doDB();
	//create clean versions of input strings
	$master_id=$_SESSION["id"];
	$safe_bookstitle = mysqli_real_escape_string($mysqli, $_POST['bookstitle']);
	//$safe_f_name = mysqli_real_escape_string($mysqli, $_POST['f_name']);
	//$safe_l_name = mysqli_real_escape_string($mysqli, $_POST['l_name']);
	//$safe_genre = mysqli_real_escape_string($mysqli, $_POST['genre']);
	$safe_series = mysqli_real_escape_string($mysqli, $_POST['series']);
	$safe_ISBN = mysqli_real_escape_string($mysqli, $_POST['ISBN']);
	$safe_note = mysqli_real_escape_string($mysqli, $_POST['note']);
	//$safe_publisher_name = mysqli_real_escape_string($mysqli, $_POST['publisher_name']);
	$safe_address = mysqli_real_escape_string($mysqli, $_POST['address']);
	$safe_city = mysqli_real_escape_string($mysqli, $_POST['city']);
	$safe_state = mysqli_real_escape_string($mysqli, $_POST['state']);
	$safe_zipcode = mysqli_real_escape_string($mysqli, $_POST['zipcode']);
	
	//update master_name table
	$add_master_sql = "UPDATE master_library SET date_added=now(),date_modified=now(),bookstitle='".$safe_bookstitle."',series='". $safe_series."'".
	                   "WHERE id=".$master_id;
	$add_master_res = mysqli_query($mysqli, $add_master_sql) or die(mysqli_error($mysqli));

	if ($_SESSION["address"]=="true"){
		//update address table
		$add_address_sql = "UPDATE address SET master_id=".$master_id.",date_added=now(),date_modified=now()".
							",address='". $safe_address ."', city='". $safe_city ."', state='". $safe_state .
							"', zipcode='". $safe_zipcode ."', type='".$_POST['add_type']."'".
							 "WHERE master_id=".$master_id;
		$add_address_res = mysqli_query($mysqli, $add_address_sql) or die(mysqli_error($mysqli));
		}
	 else if (($_POST['address']) || ($_POST['city']) || ($_POST['state']) || ($_POST['zipcode'])) {
		//add new record to table
		$add_address_sql = "INSERT INTO address (master_id, date_added, date_modified, address, city, state, zipcode, type)  VALUES ('".
							$master_id."',now(), now(), '".$safe_address."', '".$safe_city.
							"','".$safe_state."' , '".$safe_zipcode."' , '".$_POST['add_type']."')";
		$add_address_res = mysqli_query($mysqli, $add_address_sql) or die(mysqli_error($mysqli));
	}

	if ($_SESSION["notes"]=="true"){
 		//update notes table
		$add_notes_sql = "UPDATE personal_notes SET master_id=".$master_id.", date_added=now(),date_modified=now()".
		                  ",note='".$safe_note."'".
		                  "WHERE master_id=".$master_id;
		$add_notes_res = mysqli_query($mysqli, $add_notes_sql) or die(mysqli_error($mysqli));
	} else 	if ($_POST['note']) {
	  // add new record to notes table
		$add_notes_sql = "INSERT INTO personal_notes (master_id, date_added, date_modified,
		                  note)  VALUES ('".$master_id."', now(), now(), '".$safe_note."')";
		$add_notes_res = mysqli_query($mysqli, $add_notes_sql) or die(mysqli_error($mysqli));
	}

	mysqli_close($mysqli);
	$display_block = "<p>Your entry has been changed...Would you like to return to the <a href='HomeLibraryMenu.html'>main menu</a>?...<a href='LchangeEntry.php'>Change another record?</a></p>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Entry Update</title>
  <meta name="author" content="Catherine Kujawski">
  <link rel="stylesheet" href="css/styles.css?v=1.0">

</head>
<body>
<?php echo $display_block; ?>
</body>
</html>