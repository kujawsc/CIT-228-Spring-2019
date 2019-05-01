<?php
include 'Lconnect.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<div class='card text-center'><h1 class='card-header'>Select an Entry</h1><br/>";

	//get parts of records
	$get_list_sql = "SELECT id,
	                 CONCAT_WS(', ', bookstitle, series) AS display_library
	                 FROM master_library ORDER BY bookstitle, series";
	$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_list_res) < 1) {
		//no records
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";

	} else {
		//has records, so get results and print in a form
		$display_block .= "
		<section>
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<p><label for=\"sel_id\">Select a Record:</label><br/>
		<select name=\"sel_id\" id=\"sel_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_library = stripslashes($recs['display_library']);
			$display_block .= "<option value=\"".$id."\">".$display_library."</option>";
		}

		$display_block .= "
		</select></p>
		<section>
		<p><button type=\"submit\" id=\"login_button\">View Record</button></p></br>
		</form></section></br>";
	}
	//free result
	mysqli_free_result($get_list_res);

} 
else if ($_POST) {
	//check for required fields
	if ($_POST['sel_id'] == "")  {
		header("Location: Lselentry.php");
		exit;
	}

	//create safe version of ID
	$safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);

	//get master_info
	$get_master_sql = "SELECT concat_ws(' ', bookstitle, series) as display_library
	                   FROM master_library WHERE id = '".$safe_id."'";
	$get_master_res = mysqli_query($mysqli, $get_master_sql) or die(mysqli_error($mysqli));

	while ($library_info = mysqli_fetch_array($get_master_res)) {
		$display_library = stripslashes($library_info['display_library']);
	}

	$display_block = "<div class='card text-center'><h3 class='card-header'>Showing Record for $display_library</h3><br/>";


		
//free result
mysqli_free_result($get_master_res);


//get all addresses
$get_addresses_sql = "SELECT address, city, state, zipcode, type
					  FROM address WHERE master_id = '".$safe_id."'";
$get_addresses_res = mysqli_query($mysqli, $get_addresses_sql) or die(mysqli_error($mysqli));

 if (mysqli_num_rows($get_addresses_res) > 0) {

	$display_block .= "<p><strong>Addresses:</strong><br/>
	<ul>";

	while ($add_info = mysqli_fetch_array($get_addresses_res)) {
		$address = stripslashes($add_info['address']);
		$city = stripslashes($add_info['city']);
		$state = stripslashes($add_info['state']);
		$zipcode = stripslashes($add_info['zipcode']);
		$address_type = $add_info['type'];

		$display_block .= "$address $city $state $zipcode ($address_type)";
	}

	$display_block .= "</ul>";
}

//free result
mysqli_free_result($get_addresses_res);

//get personal note
$get_notes_sql = "SELECT note FROM personal_notes
				  WHERE master_id = '".$safe_id."'";
$get_notes_res = mysqli_query($mysqli, $get_notes_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_notes_res) == 1) {
	while ($note_info = mysqli_fetch_array($get_notes_res)) {
		$note = nl2br(stripslashes($note_info['note']));
	}

	$display_block .= "<p><strong>Personal Notes:</strong><br/>$note</p>";
}

//free result
mysqli_free_result($get_notes_res);

$display_block .= "<br/>
<p style=\"text-align: center\"><a href=\"Laddentry.php?master_id=".$_POST['sel_id']."\">add info</a> ...<a href=\"".$_SERVER['PHP_SELF']."\">select another</a>...<a href='HomeLibraryMenu.html'>main menu</a></p>";
}
//close connection to MySQL
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Records</title>
<meta name="author" content="Catherine Kujawski">
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>