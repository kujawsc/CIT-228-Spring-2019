<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Traveling Adventures</title>
<link rel="stylesheet" type="text/css" href="css/postExample.css"/>
</head>
<body>
<section>
    <?php
        //vars
        //
        $firstNameErr = $lastNameErr = $emailErr = $genderErr = $distanationErr = "";
        $firstName = $lastName = $email = $gender = $comment = $distanation = "";
        $northamericaSelect = $centralamericaSelect = $caribbeanSelect = $southamericaSelect = $europeSelect = $africaSelect = $middleeastSelect = $asiaSelect = $oceaniaSelect = "";
        
        //run if subbmited
        //
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //check first name
            //
            if (empty($_POST["firstname"])) {
                $firstNameErr = "First Name is required";
            } 
            else {
                $firstName = testInput($_POST["firstname"]);
                $_SESSION['firstname'] = $firstName;
                $pattern= "/^[a-zA-Z ]*$/"; 
                if (preg_match($pattern,$firstName)!== 1) {
                $firstNameErr = "Only letters and white space allowed"; 
                }
            }
            //check last name
            //
           if (empty($_POST["lastname"])) {
                $lastNameErr = "Last Name is required";
            } 
            else {
                $lastName = testInput($_POST["lastname"]);
                $_SESSION['lastname'] = $lastName;
                $pattern= "/^[a-zA-Z ]*$/"; 
                if (preg_match($pattern,$lastName)!== 1) {
                $lastNameErr = "Only letters and white space allowed"; 
                }
            }
            //check email
            //
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } 
            else {
                $email = testInput($_POST["email"]);
                $_SESSION['email'] = $email;
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }
            //check regions
            //
            if (!empty($_POST["regions"])) {
                foreach ($_POST["regions"] as $value) {
                    if ($value == "northamerica"){
                        $northamericaSelect = true;
                    }
                    if ($value == "centralamerica"){
                        $centralamericaSelect = true;
                    }
                    if ($value == "caribbean"){
                        $caribbeanSelect = true;
                    }
                    if ($value == "south america"){
                        $southamericaSelect = true;
                    }
                    if ($value == "europe"){
                        $europeSelect = true;
                    }
                    if ($value == "africa"){
                        $africaSelect = true;
                    }
                    if ($value == "middle east"){
                        $middleeastSelect = true;
                    }
                    if ($value == "asia"){
                        $asiaSelect = true;
                    }
                    if ($value == "oceania"){
                        $oceaniaSelect = true;
                    }
                }
            }
            //check distanation
            //
            if (empty($_POST["distanation"])) {
                $distanationErr = "Please select your adventure!";
            }
            //check comments
            //
            if (!empty($_POST["comment"])) {
                $comment = testInput($_POST["comment"]);
            } 
            //save if no errors
            //
            if ($firstNameErr=="" && $lastNameErr=="" && $emailErr=="" && $genderErr=="" && $distanationErr=="")
            header('Location: sessionConfirmation.php');
            
        //clean inputs
        //

        }
        function testInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <div id="formBox">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <fieldset id="box">
                <legend>Traveling Interest</legend>                

                <p>
                <label for="name" id="labelFormat">First Name:</label>
                <input class="formEntry"  id="firstname" name="firstname" size="30" style="width: 300px" value="<?php echo $firstName ?>"/>
                *<br><span class="error"><?php echo $firstNameErr;?></span><br>
                </p>

                <p>
                <label for="name" id="labelFormat">Last Name:</label>
                <input class="formEntry"  id="lastname" name="lastname" size="30" style="width: 300px" value="<?php echo $lastName ?>"/>
                *<br><span class="error"><?php echo $lastNameErr;?></span><br>
                </p>

                <p>
                <label for="email" id="labelFormat">Email:</label>
                <input class="formEntry"  id="email" name="email" size="30" style="width: 300px"  value="<?php echo $email?>"  />
                *<br><span class="error"><?php echo $emailErr;?></span><br>
                </p>

                <p>
                <label class="formLabel" for="distanation">Select A Season To Travel:</label>
                <select class="formEntry" name="distanation" id="idDistanation" style="text-align:left; width:200px;">
                    <option value="">Select One</option>                    
                    <option <?php if ($distanation == "winter") echo "selected";?> value="winter">Winter</option>
                    <option <?php if ($distanation == "spring") echo "selected";?> value="spring">Spring</option>
                    <option <?php if ($distanation == "summer") echo "selected";?> value="summer">Summer</option>
                    <option <?php if ($distanation == "fall") echo "selected";?> value="fall">Fall</option>
                </select>
                *<br><span class="error"><?php echo $distanationErr;?></span>
                </p>
                
                <p>
                <label class="formLabel" for="regions"> Regions of Interest: :</label></p>
                <div class="formEntry" style="flex-inline; margin-left:50px; width:200px; background-color: #06b0ffa8;padding: 10px;
                box-shadow: 10px 10px 10px rgb(8, 8, 8);">
                    <input type = "checkbox" name = "regions[]" id = "northamerica" value = "northamerica" <?php if ($northamericaSelect) echo "checked"; ?>>North America<br>
                    <input type = "checkbox" name = "regions[]" id = "centralamerica" value = "centralamerica" <?php if ($centralamericaSelect) echo "checked"; ?>>Central America<br>
                    <input type = "checkbox" name = "regions[]" id = "caribbean" value = "caribbean" <?php if ($caribbeanSelect) echo "checked"; ?>>Caribbean<br>
                    <input type = "checkbox" name = "regions[]" id = "southamerica" value = "southamerica" <?php if ($southamericaSelect) echo "checked"; ?>>South America<br>
                    <input type = "checkbox" name = "regions[]" id = "europe" value = "europe" <?php if ($europeSelect) echo "checked"; ?>>Europe<br>
                    <input type = "checkbox" name = "regions[]" id = "Africa" value = "africa" <?php if ($africaSelect) echo "checked"; ?>>Africa<br>
                    <input type = "checkbox" name = "regions[]" id = "middleeast" value = "middleeast" <?php if ($middleeastSelect) echo "checked"; ?>>Middle East<br>
                    <input type = "checkbox" name = "regions[]" id = "asia" value = "asia" <?php if ($asiaSelect) echo "checked"; ?>>Asia<br>
                    <input type = "checkbox" name = "regions[]" id = "oceania" value = "oceania" <?php if ($oceaniaSelect) echo "checked"; ?>>Oceania
                </div>

                <p>
                <label class="formLabel" for="gender"> * Gender: </label></p>
                <div class="formEntry" name="gender" style="display: flex; flex-wrap: wrap; margin-left:0%; background-color: #06b0ffa8;padding: 10px;
                box-shadow: 10px 10px 10px rgb(8, 8, 8);">
                    <span><label for = "female"> &nbsp;&nbsp; Female: </label>
                    <input type = "radio" name = "gender" <?php if (isset($gender) && $gender == "female") echo "checked";?> value = "female"></span>
                    <span><label for = "male"> &nbsp;&nbsp; Male: </label>
                    <input type = "radio" name = "gender" <?php if (isset($gender) && $gender == "male") echo "checked";?> value = "male"></span>
                </div>
                <br><span class="error"><?php echo $genderErr;?></span>
                </p>

                                <p>
                <label class="formLabel" for="comment">Comments:</label>
                <textarea class="formEntry" name="comment" style="resize:vertical;"><?php echo $comment?></textarea>
                </p>

                <p id="req">* required fields</p>

                <p style="flex-inline;"><input class="inputButton" type="submit" name="submit" id="submit" style="clear:both;width: 190px;">
                <input class="inputButton" type="reset" name="reset" id="reset" style="clear:both;width: 190px; margin-left:10px;"><br>
                </p>
            </fieldset>
        </form>
    </div>
    </section>
</body>
</html>