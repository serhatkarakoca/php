<?php

include("config.php");

$user_id= $_GET["user_id"];
$product_id= $_GET["product_id"];


$query = mysqli_query($connect,"select * from favorite_products where user_id = '$user_id' and product_id = '$product_id'");
$count = mysqli_num_rows($query);

class Result{
    public $tf;
    public $result;
}

$result =new Result();

if($count>0){

    $delete = mysqli_query($connect,"delete from favorite_products where  user_id = '$user_id' and product_id = '$product_id'");

    $result->tf = false;
    $result->result = "Favori silindi.";
    echo(json_encode($result));

}

else{

    $add = mysqli_query($connect,"insert into favorite_products(user_id,product_id) values ('$user_id','$product_id')");
    $result->tf = true;
    $result->result = "Favori eklendi.";
    echo(json_encode($result));


}




?>