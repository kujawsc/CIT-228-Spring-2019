<?php
$mysqli = mysqli_connect("localhost", "root", "", "grocery");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $sql = "INSERT INTO employee (name) VALUES ('Scooby Doo')";
    $res = mysqli_query($mysqli, $sql);

    if ($res === TRUE) {
        echo "A record has been inserted.";
    } else {
        printf("Could not insert record: %s\n", mysqli_error($mysqli));
    }

    mysqli_close($mysqli);
}
?>