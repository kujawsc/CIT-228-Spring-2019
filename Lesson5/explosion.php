<h1> Lesson 5 - Exercise#4 </h1>
<h2> Breaking strings into Arrays </h2>

<?php
$rawPhoneNumber = "231-735-1151 <br/>"; 

$phoneChunks = explode("-", $rawPhoneNumber);
echo "Raw Phone Number = $rawPhoneNumber <br/>";
echo "First chunk = $phoneChunks[0]<br/>";
echo "Second chunk = $phoneChunks[1]<br/>";
echo "Third Chunk chunk = $phoneChunks[2]";
?>