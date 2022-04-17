<?php

include "config.php";

$user_id = $_POST["user_id"];
$title = $_POST["title"];
$description = $_POST["description"];
$price = $_POST["price"];
$category = $_POST["category"];

class Result {
    public $user_id;
    public $product_id;
    public $tf;
}

$result = new Result();

$add = mysqli_query($connect,"insert into products(user_id,title,description,price,category) values ('$user_id','$title','$description','$price','$category')");
if($add){

    $sor = mysqli_query($connect,"select * from products where user_id='$user_id' order by id desc limit 1");
    $sor2 = mysqli_fetch_assoc($sor);
        $result->user_id = $sor2["user_id"];
        $result->product_id = $sor2["id"];
        $result->tf = true;
        echo(json_encode($result));
}

?>