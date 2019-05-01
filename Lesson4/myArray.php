<?php
    $index = array("Panama","Costa Rica","Mexico","Brazil","Cuba");

    $asso = array(
        01=>"Januray",
        02=>"February",
        03=>"March",
        04=>"April",
        05=>"May",
        06=>"June",
        07=>"July",
        08=>"August",
        09=>"September",
        10=>"October",
        11=>"November"

    );

    $multi = array (
        array("March", "Costa Rica", 1, 25),
        array("November", "Mexico", 2, 26),
        array("May", "Brazil", 3, 27),
        array("June", "Cuba", 4, 28),
        array("February", "Cuba", 5, 29)
    );

    function printArrays($index,$asso,$multi){
        echo "<h2 style='color:Red'>The Countries</h2>";
        printf("<pre>%-6s %-20s<br>","Index","Countries");
        printf("====================================================================<br>");
        for ($n = 0; $n < count($index); $n++) {
            printf("%-6s %-20s <br>",$n ,$index[$n]);
        }
        printf("</pre>");

        echo "<h2 style='color:blue'> The Months</h2>";
        printf("<pre>%-6s %-20s<br>","Month","Game");
        printf("====================================================================<br>");
        foreach ($asso as $y => $g) {
            printf("%-6s %-20s <br>",$y ,$g);
        }
        printf("</pre>");

        echo "<h2 style='color:green'> Traveling Info</h2>";
        printf("<pre>%-20s %-15s %-10s %-6s<br>","Month","Country","Seat Number","FLight Number");
        printf("====================================================================<br>");
        foreach ($multi as $m) {
            printf("%-20s %-15s %-10s %-6d<br>",$m[0] , $m[1], $m[2], $m[3]);
        }
        printf("</pre><br><hr><br>");
    }

    echo "<h1>Before Addition</h1>";
    printArrays($index,$asso,$multi);
    //add to index
    //
    array_push($index,"Colombia");
    
    //add to asso
    //
    $asso[12] = "December";
    //add to multi
    //
    $multi[count($multi)+1] = array("July", "Brazil", 6, 30);
    echo "<h1>After Addition</h1>";
    printArrays($index,$asso,$multi);    
?>