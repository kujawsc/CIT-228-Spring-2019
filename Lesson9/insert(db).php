<?php
$mysqli = mysqli_connect("localhost", "root", "", "companydb");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $clean_id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $clean_id =test_input($clean_id);
    $clean_custName = mysqli_real_escape_string($mysqli, $_POST['custName']);
    $clean_custName =test_input($clean_custName);
    $clean_mobilePhone = mysqli_real_escape_string($mysqli, $_POST['mobilePhone']);
    $clean_mobilePhone =test_input($clean_mobilePhone);
    $clean_emailAddr = mysqli_real_escape_string($mysqli, $_POST['emailAddr']);
    $clean_emailAddr =test_input($clean_emailAddr);
    $sql = "INSERT INTO customer (id,custName, mobilePhone, emailAddr) 
    VALUES ('".$clean_id."','".$clean_custName."','".$clean_mobilePhone."','".$clean_emailAddr."')";
    $res = mysqli_query($mysqli, $sql);

    if ($res === TRUE) {
        echo "A record has been inserted.";
    } else {
        printf("Could not insert record: %s\n", mysqli_error($mysqli));
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