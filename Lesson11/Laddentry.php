<?php
include 'Lconnect.php';

if (!$_POST) {
	//haven't seen the form, so show it
	$display_block = <<<END_OF_BLOCK
	<form method="post" action="$_SERVER[PHP_SELF]">
	<section class="form-section vertical-center login-section">
	<div class="card text-center">
                <h1 class="card-header">
				Add an Entry
				</h1>

				<div class="card-body">
					  <label for="bookstitle">Book Title</label><br>
					  <input name="bookstitle" type="text" required="required></br>

					  <label for="genre">Genre</label></br>
					  <input type="text" name="genre" required="required></br>

					  <label for="series">Series</label></br>
					  <input type="text" name="series" required="required></br>

					  <label for="ISBN">ISBN</label></br>
					  <input type="text" name="ISBN" required="required></br>

					  <label for="author">Author First and Last Name</label></br>
					  <input type="text" name="f_name" required="required" />
					  <input type="text" name="l_name" required="required" />

					  <label for="address">Publisher Street Address</label></br>
					  <input type="text" name="address" required="required></br>

					  <label for="address">City/State/Zip</label></br>
					  <input type="text" name="city" size="50" maxlength="50" />
					  <input type="text" name="state" size="5" maxlength="2" />
					  <input type="text" name="zipcode" size="10" maxlength="10" />

					  <label for="address">Address Type</label></br>
					  <label for="add_type_h">home<input type="radio" id="add_type_h" name="add_type" value="Home" checked /></label></br>
						  
					  <label for="add_type_w">work<input type="radio" id="add_type_w" name="add_type" value="Work" /></label></br>
					  
					  <label for="add_type_o">other<input type="radio" id="add_type_o" name="add_type" value="Other" /></label></br>
					  					  
					 <label for="personal_notes">Personal Notes</label></br>
					 <textarea id="note" name="note" cols="35" rows="3"></textarea></p>

					 <button type="submit" id="login_button">Add Entry</button>
					 </div>
			</div>
		</div>
</section>
	
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

	//$add_publisher_sql = "INSERT INTO publisher_name (master_id, date_added, date_modified, publisher)
						//VALUES ('".$master_id."', now(), now(), '".$safe_publisher."')";
	//$add_publisher_res = mysqli_query($mysqli, $add_publisher_sql) or die(mysqli_error($mysqli));

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
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Add Entry</title>
  <meta name="author" content="Catherine Kujawski">
    
  <!-- custom styles -->
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
<?php echo $display_block; ?>
</body>
</html>