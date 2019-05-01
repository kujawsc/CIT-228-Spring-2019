<?php
include 'Lconnect.php';

if (!$_POST) {
	//haven't seen the form, so show it
	$display_block = <<<END_OF_BLOCK
	<form method="post" action="$_SERVER[PHP_SELF]">

	<fieldset>
	<legend>Book Title:</legend><br/>
	<input type="text" name="bookstitle" size="20" maxlength="75" required="required"/>
	</fieldset>

	<fieldset>
	<legend>Genre:</legend><br/>
	<input type="text" name="genre" size="100" maxlength="150" required="required"/>
	</fieldset>

	<fieldset>
	<legend>Series:</legend><br/>
	<input type="text" name="series" size="100" maxlength="150" required="required"/>
	</fieldset>

	<fieldset>
	<legend>ISBN:</legend><br/>
	<input type="text" name="ISBN" size="30" maxlength="25" />
	</fieldset>

	<fieldset>
	<legend>Author First/Last Names:</legend><br/>
	<input type="text" name="f_name" size="30" maxlength="75" required="required" />
	<input type="text" name="l_name" size="30" maxlength="75" required="required" />
	</fieldset>

	<fieldset>
	<p><label for="address">Publisher Street Address:</label><br/>
	<input type="text" id="address" name="address" size="30" /></p>
	</fieldset>

	<fieldset>
	<legend>City/State/Zip:</legend><br/>
	<input type="text" name="city" size="30" maxlength="50" />
	<input type="text" name="state" size="5" maxlength="2" />
	<input type="text" name="zipcode" size="10" maxlength="10" />
	</fieldset>

	<fieldset>
	<legend>Address Type:</legend><br/>
	<input type="radio" id="add_type_h" name="add_type" value="home" checked />
	    <label for="add_type_h">home</label>
	<input type="radio" id="add_type_w" name="add_type" value="work" />
	    <label for="add_type_w">work</label>
	<input type="radio" id="add_type_o" name="add_type" value="other" />
	    <label for="add_type_o">other</label>
	</fieldset>

	<p><label for="note">Personal Notes:</label><br/>
	<textarea id="note" name="note" cols="35" rows="3"></textarea></p>

	<button type="submit" name="submit" value="send">Add Entry</button>
	</form>
END_OF_BLOCK;

} else if ($_POST) {
	//time to add to tables, so check for required fields
	if (($_POST['bookstitle'] == "") || ($_POST['series'] == "")) {
		header("Location: Laddentry.php");
		exit;
	}

	//connect to database
	doDB();

	//create clean versions of input strings
	$safe_bookstitle = mysqli_real_escape_string($mysqli, $_POST['bookstitle']);
	$safe_f_name = mysqli_real_escape_string($mysqli, $_POST['f_name']);
	$safe_l_name = mysqli_real_escape_string($mysqli, $_POST['l_name']);
	$safe_genre = mysqli_real_escape_string($mysqli, $_POST['genre']);
	$safe_series = mysqli_real_escape_string($mysqli, $_POST['series']);
	$safe_ISBN = mysqli_real_escape_string($mysqli, $_POST['ISBN']);
	$safe_note = mysqli_real_escape_string($mysqli, $_POST['note']);
	//$safe_publisher_name = mysqli_real_escape_string($mysqli, $_POST['publisher_name']);
	$safe_address = mysqli_real_escape_string($mysqli, $_POST['address']);
	$safe_city = mysqli_real_escape_string($mysqli, $_POST['city']);
	$safe_state = mysqli_real_escape_string($mysqli, $_POST['state']);
	$safe_zipcode = mysqli_real_escape_string($mysqli, $_POST['zipcode']);

	//add to master_name table
	$add_master_library_sql = "INSERT INTO master_library (date_added, date_modified, bookstitle, series, ISBN)
                       VALUES (now(), now(),'".$safe_bookstitle."', '".$safe_series."', '".$safe_ISBN."')";
	$add_master_library_res = mysqli_query($mysqli, $add_master_library_sql) or die(mysqli_error($mysqli));
	

	//get master_library_id for use with other tables
	$master_id = mysqli_insert_id($mysqli);

	$add_author_sql = "INSERT INTO author (master_id, date_added, date_modified, f_name, l_name)
                       VALUES ('".$master_id."', now(), now(), '".$safe_f_name."', '".$safe_l_name."')";
	$add_author_res = mysqli_query($mysqli, $add_author_sql) or die(mysqli_error($mysqli));

	$add_genre_sql = "INSERT INTO genre (master_id, date_added, date_modified, genre)
                       VALUES ('".$master_id."', now(), now(), '".$safe_genre."')";
	$add_genre_res = mysqli_query($mysqli, $add_genre_sql) or die(mysqli_error($mysqli));

	if (($_POST['address']) || ($_POST['city']) || ($_POST['state']) || ($_POST['zipcode'])) {
		//something relevant, so add to address table
		$add_address_sql = "INSERT INTO address (master_id, date_added, date_modified, address, city, state, zipcode, type)  VALUES ('".$master_id."',
							now(), now(), '".$safe_address."', '".$safe_city."', '".$safe_state."' , '".$safe_zipcode."' , '".$_POST['add_type']."')";
		$add_address_res = mysqli_query($mysqli, $add_address_sql) or die(mysqli_error($mysqli));
		}

	if ($_POST['note']) {
			//something relevant, so add to notes table
			$add_notes_sql = "INSERT INTO personal_notes (master_id, date_added, date_modified,
							  note)  VALUES ('".$master_id."', now(), now(), '".$safe_note."')";
			$add_notes_res = mysqli_query($mysqli, $add_notes_sql) or die(mysqli_error($mysqli));
			}

	mysqli_close($mysqli);
	$display_block = "<p>Your entry has been added.  Would you like to <a href=\"Laddentry.php\">add another</a>?...Would you like to return to the <a href='HomeLibraryMenu.html'>main menu</a>?</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add an Entry</title>
<link href="css/library.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1>Add an Entry</h1>
<?php echo $display_block; ?>
</body>
</html>