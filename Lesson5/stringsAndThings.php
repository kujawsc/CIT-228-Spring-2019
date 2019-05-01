<h1> Lesson 5 - Exercise#2 </h1>
<h2> Working with Strings </h2>

<?php
$products = array ("Suite case" => "65.99",
                   "Traveling pillow" => "25.99",
                   "Sleeping Mask" => "5.19");
echo "<pre>";
printf("%-20s%20s\n", "Product Name", "Price");
printf("%'-40s\n", "");
foreach ($products as $key=>$val) {
    printf( "%-20s%20.2f\n", $key, $val );
}
echo "</pre>";
?>