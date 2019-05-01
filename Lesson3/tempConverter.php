<header>
    <h1>Lesson 3 - Exercise #3 <h1>
    <h2>Creating a table using a loop</h2>
</header>
<?php
    $celsius=0.0;
    $counter=0;
    echo "<table> <tr><th>Celsius</th> <th>Fahrenheit</th></tr>";
    while ($counter <10) {
        $fahrenheit = 9/5 * ($celsius + 32);
    echo "<tr style='width:20px; text-align:center; height: 40px;'><td>". $celsius. "</td><td>" .$fahrenheit."</td></tr>";
    $celsius +=5;
    $counter++;
    }
    echo "</table>";
?>