<?php
include 'Lconnect.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<h1>Select an Entry</h1>";

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
		<button type=\"submit\" name=\"submit\" value=\"del\">Delete Selected Entry</button>
		</form>";
	}
	//free result
	mysqli_free_result($get_list_res);
} else if ($_POST) {
	//check for required fields
	if ($_POST['sel_id'] == "")  {
		header("Location: Ldelentry.php");
		exit;
	}

    //create safe version of ID
    $safe_id = mysqli_real_escape_string($mysqli, $_POST['sel_id']);

	//issue queries
	$del_master_sql = "DELETE FROM master_library WHERE id = '".$safe_id."'";
	$del_master_res = mysqli_query($mysqli, $del_master_sql) or die(mysqli_error($mysqli));

	$del_address_sql = "DELETE FROM address WHERE master_id = '".$safe_id."'";
	$del_address_res = mysqli_query($mysqli, $del_address_sql) or die(mysqli_error($mysqli));

	$del_note_sql = "DELETE FROM personal_notes WHERE master_id = '".$safe_id."'";
	$del_note_res = mysqli_query($mysqli, $del_note_sql) or die(mysqli_error($mysqli));

	mysqli_close($mysqli);

	$display_block = "<h1>Record(s) Deleted</h1><p>Would you like to
	<a href=\"".$_SERVER['PHP_SELF']."\">delete another</a>?...Return to the <a href='HomeLibraryMenu.html'>main menu</a>?</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>My Records</title>
<link href="css/library.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>
