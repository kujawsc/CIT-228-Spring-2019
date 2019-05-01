<header>
    <h1>Lesson 3 - Exercise #1 <h1>
    <h2>Using strings, user-defined fuctions and css.</h2>
</header>
<?php
    function travelingGuide($txt, $size, $color){
        
        echo "<span style=\"background-color:$color; font-size:$size\">". $txt."</span><br/>";

        }
        travelingGuide("Sarah, will like to travel to France next summer.", "20pt", "red");
        travelingGuide("Fred, will like to travel to Italy next winter.", "15pt", "green");
        travelingGuide("Sookie, will like to travel to Costa Rica next spring.", "24pt", "orange");
?>
