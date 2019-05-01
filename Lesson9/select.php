<?php
$mysqli = mysqli_connect("localhost", "root", "", "grocery");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $sql = "SELECT * FROM employee";
    $res = mysqli_query($mysqli, $sql);

if ($res) {
    while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $id = $newArray['id'];   // subscript into array with the field name defined in the table
        $empName = $newArray['name'];   // subscript into array with the field name defined in the table
        echo "The ID is ".$id." and the text is: ".$empName."<br/>";   //  use the php variable names assigned above
    }
} else {
    printf("Could not retrieve records: %s\n", mysqli_error($mysqli));
}

    mysqli_free_result($res);
    mysqli_close($mysqli);
}
?>