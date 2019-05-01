<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf‐8" http‐equiv="Content‐Type">
<title>Submission Confirmation</title>
<link rel="stylesheet" type="text/css" href="css/postExample.css" />
</head>
<body>
<section>
<?php
if (isset($_SESSION['firstname']))
  echo  "<p>" . $_SESSION['firstname'] . " your information has been submitted.</p>";
else
   echo "<p>Your information has been submitted.</p>";
if (isset($_SESSION['email']))
  echo "<p>Confirmation will be emailed to: " . $_SESSION['email'] . "</p>";
else
  echo "<p>You will receive confirmation through your email</p>";     
?>
</section>
</body>
</html>