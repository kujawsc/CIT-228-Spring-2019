<!DOCTYPE html>
<html>
<header>
    <h1>Exercise #1 <h1>
    <h2>Working with different data types, user-defined functions 
    and builting functions</h2>
</header>
<?php      
    echo "First Value = Summer <br><br>";
    $value1 = 'Summer';
    
    echo "Is the value a string?".is_string($value1); //checking string
    echo "<br/>";
    echo "Is the value a null?".is_null($value1); //checking null
    echo "<br/>";
    echo "Is the value a double?".is_double($value1); //checking double
    echo "<br/>";
    echo "Is the value a boolean?".is_bool($value1); //checking boolean
    echo "<br/><br>";

    echo "Second Value = Sookie <br><br>";
    $value2 = "Sookie";

    echo "Is the value a string?".is_string($value2); //checking string
    echo "<br/>";
    echo "Is the value a null?".is_null($value2); //checking null
    echo "<br/>";
    echo "Is the value a double?".is_double($value2); //checking double
    echo "<br/>";
    echo "Is the value a array?".is_array($value2); //checking boolean
    echo "<br/><br>";

    echo "Third Value = 27 <br><br>";
    $value3 = 27;

    echo "Is the value a null?".is_null($value3); //checking null
    echo "<br/>";
    echo "Is the value a integer?".is_integer($value3); //checking interger
    echo "<br/>";
    echo "Is the value a double?".is_double($value3); //checking double
    echo "<br/>";
    echo "Is the value a boolean?".is_bool($value3); //checking boolean
    echo "<br/><br>";

    echo "Fourth Value = Winter Storm <br><br>";
    $value4 = "Winter Storm";

    echo "Is the value a float?".is_float($value4); //checking float
    echo "<br/>";
    echo "Is the value a integer?".is_integer($value4); //checking interger
    echo "<br/>";
    echo "Is the value a double?".is_double($value4); //checking double
    echo "<br/>";
    echo "Is the value a array?".is_array($value4); //checking array
    echo "<br/><br>";

    echo "Fifth Value = 1992 <br><br>";
    $value5 = 1992;

    echo "Is the value a float?".is_float($value5); //checking float
    echo "<br/>";
    echo "Is the value a integer?".is_integer($value5); //checking interger
    echo "<br/>";
    echo "Is the value a double?".is_double($value5); //checking double
    echo "<br/>";
    echo "Is the value a boolean?".is_resource($value5); //checking resource
    echo "<br/><br>";

?>
</body>
</html>