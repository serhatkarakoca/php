<?php

include("config.php");


$product_id = $_GET["product_id"];

class Result{

    public $image_path;

}

$result = new Result();

$stmp = mysqli_query($connect,"select * from product_images where product_id ='$product_id'");
$size = mysqli_num_rows($stmp);
$counter = 0;

echo("[");
while($pass = mysqli_fetch_assoc($stmp)){
    $counter = $counter+1;

    $result->image_path =$pass["image_path"];
    echo(json_encode($result));
    if(($size)>$counter){
            echo(",");

    }


}
echo("]");

?>