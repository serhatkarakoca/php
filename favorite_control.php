<?php

include("config.php");

$user_id = $_GET["user_id"];
$product_id = $_GET["product_id"];

$query = mysqli_query($connect,"select * from favorite_products where user_id='$user_id' and product_id = '$product_id'");

$count = mysqli_num_rows($query);

class Result{

    public $result;
    public $tf;

}

$result = new Result();
if($count>0){
    $result->result = "It is a favorite product";
    $result->tf = true;
    echo(json_encode($result));
}

else{
    $result->result = "It is not a favorite product";
    $result->tf = false;
    echo(json_encode($result));
}









?>