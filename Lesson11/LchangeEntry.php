<?php
session_start();
include 'Lconnect.php';
doDB();

if (!$_POST)  {
	//haven't seen the selection form, so show it
	$display_block = "<div class='card text-center'><h1 class='card-header'>Select an Entry to Update</h1><br/>";
	
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
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\"></br>
		<p><label for=\"change_id\">Select a Record to Update:<br/>
		<select name=\"change_id\" id=\"change_id\" required=\"required\"</label><br/>
		<option value=\"\">-- Select One --</option></br>";

		while ($recs = mysqli_fetch_array($get_list_res)) {
			$id = $recs['id'];
			$display_library = stripslashes($recs['display_library']);
			$display_block .= "<option value=\"".$id."\">".$display_library."</option>";
		}

		$display_block .= "
		</select></p>
		<section>
		<p><button type=\"submit\" id=\"login_button\">Change Selected Entry</button></p></br>
		</form></section></br>";
	}
	//free result
	mysqli_free_result($get_list_res);

} else if ($_POST) {
	//check for required fields
	if ($_POST['change_id'] == "")  {
		header("Location: LchangeEntry.php");
		exit;
	}

	//create safe version of ID
	$safe_id = mysqli_real_escape_string($mysqli, $_POST['change_id']);
	$_SESSION["id"]=$safe_id;
	$_SESSION["address"]="true";
	$_SESSION["notes"]="true";
	//get master_info
	$get_master_sql = "SELECT bookstitle, series, ISBN FROM master_library WHERE id = '".$safe_id."'";
	$get_master_res = mysqli_query($mysqli, $get_master_sql) or die(mysqli_error($mysqli));

	while ($name_info = mysqli_fetch_array($get_master_res)) {
		$display_bookstitle = stripslashes($name_info['bookstitle']);
		$display_series = stripslashes($name_info['series']);
		$display_ISBN = stripslashes($name_info['ISBN']);		
	
	}
	
	$display_block = "<div class='card text-center'><h1 class='card-header'>Record Updates</h1><br/>";
	$display_block.="<form method='post' action='Lchange.php'>";
	$display_block.="<div class='card text-center'><h3 class='card-header'>Books Information</h3><br/>";
	$display_block.="<div class='card-body'><label for='bookstitle'>Book Title<input type='text' name='bookstitle' required='required' value='". $display_bookstitle. "'/></label></br>";
	$display_block.="<label for='series'>Series<input type='text' name='series' required='required' value='". $display_series. "'/></label></br>";
	$display_block.="<label for='ISBM'>ISBM<input type='text' name='ISBM' required='required' value='". $display_ISBN. "'/></label>";

	//free result
	mysqli_free_result($get_master_res);
	//get all addresses
	$get_addresses_sql = "SELECT address, city, state, zipcode, type
	                      FROM address WHERE master_id = '".$safe_id."'";
	$get_addresses_res = mysqli_query($mysqli, $get_addresses_sql) or die(mysqli_error($mysqli));

 	if (mysqli_num_rows($get_addresses_res) > 0) {

		$display_block .= "<div class='card text-center'><h3 class='card-header'>Publisher Address</h3><br/>";

		while ($add_info = mysqli_fetch_array($get_addresses_res)) {
			$address = stripslashes($add_info['address']);
			$city = stripslashes($add_info['city']);
			$state = stripslashes($add_info['state']);
			$zipcode = stripslashes($add_info['zipcode']);
			$address_type = $add_info['type'];

			$display_block.="<div class='card-body'><label for='address'>Street Address<input type='text' name='address' required='required' value='". $address. "'/></label></br>";
			$display_block .= "<label for='address'>City/State/Zip</label><input type='text' name='city' value='" . $city . "'/><input type='text' name='state' value='".$state."'/><input type='text' name='zipcode' value='".$zipcode."'/></fieldset>";
			$display_block .="<fieldset><legend>Address Type:</legend><br/>";
			if ($address_type=="home"){
				$display_block .="<input type='radio' id='add_type_h' name='add_type' value='home' checked='checked' /><label for='add_type_h'>home</label>";
				$display_block .="<input type='radio' id='add_type_w' name='add_type' value='work' /><label for='add_type_w'>work</label>";
				$display_block .="<input type='radio' id='add_type_o' name='add_type' value='other' /><label for='add_type_o'>other</label>";
			}
			else if ($address_type=="work"){
				$display_block .="<input type='radio' id='add_type_h' name='add_type' value='home'  /><label for='add_type_h'>home</label>";
				$display_block .="<input type='radio' id='add_type_w' name='add_type' value='work' checked='checked'/><label for='add_type_w'>work</label>";
				$display_block .="<input type='radio' id='add_type_o' name='add_type' value='other' /><label for='add_type_o'>other</label>";
			}
			else{
				$display_block .="<input type='radio' id='add_type_h' name='add_type' value='home' /><label for='add_type_h'>home</label>";
				$display_block .="<input type='radio' id='add_type_w' name='add_type' value='work' /><label for='add_type_w'>work</label>";
				$display_block .="<input type='radio' id='add_type_o' name='add_type' value='other' checked='checked' /><label for='add_type_o'>other</label>";
			}	
		}
	$display_block .="</fieldset>";
	}
	else{
	$_SESSION["address"]='false';
	$display_block .= <<<END_OF_BLOCK
	<label for="address">Publisher Street Address</label></br>
	<input type="text" name="address" required="required></br>

	<label for="address">City/State/Zip</label></br>
	<input type="text" name="city" size="50" maxlength="50" />
	<input type="text" name="state" size="5" maxlength="2" />
	<input type="text" name="zipcode" size="10" maxlength="10" />
	
	<label for="address">Address Type</label></br>
	label for="add_type_h">home<input type="radio" id="add_type_h" name="add_type" value="Home" checked /></label></br>
	<label for="add_type_w">work<input type="radio" id="add_type_w" name="add_type" value="Work" /></label></br>
	<label for="add_type_o">other<input type="radio" id="add_type_o" name="add_type" value="Other" /></label></br>
				  					  
END_OF_BLOCK;
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
		$display_block .= "<p><label for='note'>Personal Note:</label><br/>";
		$display_block .= "<textarea id='note' name='note' cols='35' rows='3'>".$note."</textarea></p>";
	}
	else{
	$_SESSION["notes"]='false';
	$display_block .= '<p><label for="note">Personal Note</label><br/><textarea id="note" name="note" cols="35" rows="3"></textarea></p>';
	}
	
	//free result
	mysqli_free_result($get_notes_res);

	$display_block .= "<p style=\"text-align: center\"><button type='submit' name='submitChange' id='login_button' value='submitChange'>Change Entry</button></br>";
	$display_block .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href='HomeLibraryMenu.html' style='color:darkgreen';>Cancel and return to main menu</a></p></form>";
}
//close connection to MySQL
mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Library Record</title>
  <meta name="author" content="Catherine Kujawski">
  <link rel="stylesheet" href="css/styles.css?v=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


</head>
<body>
<?php echo $display_block; ?>
</body>
</html>

