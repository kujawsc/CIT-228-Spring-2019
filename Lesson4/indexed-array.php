<h1> Lesson 4 - Exercise#1 </h1>
<h2> Working with Indexed Arrays </h2>

<?php
    $salePrice = array(9.99, 15.99, 24.99, 29.99);
    $regPrice = array(15.00, 25.00, 30.00, 40.00);
    $quantity = array(1, 2, 3, 4);
    $shadePlants = array("Lilly-of-the-Valley", "Gibraltar Axalea", "Hydrangea", "Japanese Painted Fern","Silver Gem Appalachian Blue Violet", "Snowbelle Mockorange" );
    $sunPlants = array("Jewel of Desert Peridot Ice Plant", "Rose", "Hollyhock", "Peony", "Tutti Frutti Hummingbird Mint", "Bergenia Dragonfly 'Sakura'", "Indian Summer Peruvian Lily", "Kaleidoscope Butterfly Bush");

    echo "<h1 style='font-family: batang, calibri, cambria, serif; color: green'> Shade Plants</h1>";
    for($x=0; $x<count($shadePlants); $x++) 
        echo $shadePlants[$x]. "</br>";

    echo "<hr><h1 style = 'font-family: batang, calibri, serif; color: green'> Sun Plants</h1>";
    for($x=0; $x<count($sunPlants); $x++) 
        echo $sunPlants[$x]. "</br>";

    echo "<hr><h1 style = 'font-family: batang, calibri, serif; color: green'> Quantity and Pricing</h1>";
    printf("<pre><span style = 'font-family: batang, calibri, serif; font-size: 12pt;'>");
    for($x=0; $x<count($quantity); $x++)
        printf("%4d item at $ %-6.2f each is in sake for <span style = 'color:red'> $ %-6.2f</span> each <br>",$quantity[$x], $regPrice[$x], $salePrice [$x]);
        printf("</span></pre>");
?>