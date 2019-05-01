<h1> Lesson 4 - Exercise#2 </h1>
<h2> Working with Associative Arrays </h2>

<?php
    $salePrice = array(1 => 9.99, 2 => 15.99, 3 => 24.99, 4 => 29.99);
    $regPrice = array(1 => 15.00, 2 => 25.00, 3 => 30.00, 4 => 40.00);
    
    $shadePlants = array("Lilly-of-the-Valley", "Gibraltar Axalea", "Hydrangea", "Japanese Painted Fern","Silver Gem Appalachian Blue Violet", "Snowbelle Mockorange" );
    $sunPlants = array("Jewel of Desert Peridot Ice Plant", "Rose", "Hollyhock", "Peony", "Tutti Frutti Hummingbird Mint", "Bergenia Dragonfly 'Sakura'", "Indian Summer Peruvian Lily", "Kaleidoscope Butterfly Bush");

    echo "<h1 style='font-family: batang, calibri, cambria, serif; color: green'> Shade Plants</h1>";
    for($x=0; $x<count($shadePlants); $x++) 
        echo $shadePlants[$x]. "</br>";

    echo "<hr><h1 style = 'font-family: batang, calibri, serif; color: green'> Sun Plants</h1>";
    for($x=0; $x<count($sunPlants); $x++) 
        echo $sunPlants[$x]. "</br>";

    echo "<hr><h1 style = 'font-family: batang, calibri, serif; color: green'> Quantity and Pricing</h1>";
    echo "<pre><span style = 'font-family: batang, calibri, serif; font-size: 10pt;'>";
    foreach($salePrice as $x=>$x_value)
        echo "A quantity of " .$x. "is on sale for <span style = 'color:red;'>" .$x_value. "</span><br>";
    echo "</span></pre>";
?>