<?php
$mysqli = mysqli_connect("localhost", "root", "", "companydb");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $clean_custName= mysqli_real_escape_string($mysqli, $_POST['custName']);
    $clean_custName =test_input($clean_custName);
    $sql = "DELETE FROM customer WHERE custName='".$clean_custName."'";
    $res = mysqli_query($mysqli, $sql);
    if ($res === TRUE) {
        echo "A record has been deleted.";
    } else {
        printf("Could not delete record: %s\n", mysqli_error($mysqli));
    }
    mysqli_close($mysqli);
    }
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>