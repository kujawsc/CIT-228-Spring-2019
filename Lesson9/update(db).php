<?php
$mysqli = mysqli_connect("localhost", "root", "", "companydb");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $clean_old_custName = mysqli_real_escape_string($mysqli, $_POST['custName']);
    $clean_old_custName =test_input($clean_old_custName);
    $clean_new_custName = mysqli_real_escape_string($mysqli, $_POST['newcustName']);
    $clean_new_custName =test_input($clean_new_custName);
    $sql = "UPDATE customer SET custName='".$clean_new_custName."' WHERE custName='" . $clean_old_custName ."'";
    $res = mysqli_query($mysqli, $sql);
    if ($res === TRUE) {
        echo "The record has been updated.";
    } else {
        printf("The record could not be updated: %s\n", mysqli_error($mysqli));
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