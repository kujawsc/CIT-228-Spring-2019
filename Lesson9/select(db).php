<?php
$mysqli = mysqli_connect("localhost", "root", "", "companydb");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $sql = "SELECT * FROM customer";
    $res = mysqli_query($mysqli, $sql);

if ($res) {
    while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $id = $newArray['id'];   // subscript into array with the field name defined in the table
        $custName = $newArray['custName'];   // subscript into array with the field first name defined in the table
        $custemailAddr = $newArray['emailAddr']; //subscript into array with the field email addr defined in the table
        echo "The ID is ".$id." and the text is: ".$custName."</br>";   //  use the php variable names assigned above
        echo "The ID is ".$id." and the customer email is: ".$custemailAddr."<br><br>";   //  use the php variable names assigned above
    }
} else {
    printf("Could not retrieve records: %s\n", mysqli_error($mysqli));
}

    mysqli_free_result($res);
    mysqli_close($mysqli);
}
?>