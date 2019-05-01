<!DOCTYPE html>
<html>
<body>
    <header>
        <h1>Exercise #2 <h1>
        <h2>Using Operators<h2>
    </header>
<?php 
    function sum($number1, $number2) {
        $numbersum = $number1 = $number2;
        return $numbersum;
    }
    echo " --- Addition --- <br><br>";
    echo "65 + 5 = ". sum(65,5) . "<br>";
    echo "55 + 80 = ". sum(55,80) . "<br>";
    echo "<br>";

    echo " --- Subtraction --- <br><br>";
    echo "65 - 15 = ". sum(65,15) . "<br>";
    echo "102 - 80 = ". sum(102,80) . "<br>";
    echo "<br>";

    echo " --- Multiplication --- <br><br>";
    echo "100 * 45 = ". sum(100,45) . "<br>";
    echo "45 * 88 = ". sum(45,88) . "<br>";
    echo "<br>";
    
    echo " --- Division --- <br><br>";
    echo "10 / 45 = ". sum(10,45) . "<br>";
    echo "45 / 50 = ". sum(45,50) . "<br>";
    echo "<br>";
?>
</body>
</html>