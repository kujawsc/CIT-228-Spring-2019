<?php
$mysqli = mysqli_connect("localhost", "root", "", "grocery");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $clean_old_name = mysqli_real_escape_string($mysqli, $_POST['empName']);
    $clean_old_name =test_input($clean_old_name);
    $clean_new_name = mysqli_real_escape_string($mysqli, $_POST['newName']);
    $clean_new_name =test_input($clean_new_name);
    $sql = "UPDATE employee SET name='".$clean_new_name."' WHERE name='" . $clean_old_name ."'";
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