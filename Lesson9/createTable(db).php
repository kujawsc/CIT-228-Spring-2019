<?php
$con = mysqli_connect("localhost", "root", "", "companydb");

if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The grocery database is great." ;
echo "Host information: " . mysqli_get_host_info($con);

mysqli_close($con);
?>