<?php

include("config.php");

class Result{
   public $result;
   public $tf;
}

$result = new Result();

$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];
$address = $_POST["address"];
$latitude = $_POST["latitude"];
$longtitude = $_POST["longtitude"];
$city = $_POST["city"];
$state = $_POST["state"];
$country = $_POST["country"];
$postal_code = $_POST["postal_code"];

$add = mysqli_query($connect,"insert into Adresses(user_id,product_id,address,latitude,longtitude,city,state,country,postal_code) values('$user_id','$product_id','$address','$latitude','$longtitude','$city','$state','$country','$postal_code')");

if($add){

    $result->tf=true;
    $result->result="Adres eklendi.";
    echo(json_encode($result));
}

?>