<h1> Lesson 5 - Exercise#5 </h1>
<h2> Making a time stamp </h2>

<?php
// make a timestamp for Jan 17 2019 at 9:55 am
$ts = mktime(9, 55, 0, 1, 17, 2019);
echo date("m/d/y G:i:s e", $ts);
echo "<br/>";
echo "The date is ";
echo date("jS \of F Y, \a\\t g:ia \i\\n e", $ts );
?>