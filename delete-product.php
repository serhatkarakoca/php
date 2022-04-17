<?php

include("config.php");

$product_id =$_GET["product_id"];

class Result{
    
    public $result;
    public $tf;
}

$result = new Result();

$productExist = mysqli_query($connect,"select *from products where id ='$product_id'");

if(mysqli_num_rows($productExist)>0){
    $deleteP = mysqli_query($connect,"DELETE FROM products WHERE id = '$product_id'");
    $deleteI = mysqli_query($connect,"delete from product_images where product_id = '$product_id'");
    $deleteA = mysqli_query($connect,"delete from Adresses where product_id = '$product_id'");
    $control = mysqli_query($connect,"select *from products where id ='$product_id'");
    if(mysqli_num_rows($control)<1 && $productExist > 0){
    $result->tf = true;
    $result->result ="OK";
    echo(json_encode($result));

}
else{
    $result->tf = false;
    $result->result ="DELETE NOT SUCCESSFULL";
    echo(json_encode($result));
}
}
else{
    $result->tf = false;
    $result->result ="ERROR PRODUCT NOT FOUND";
    echo(json_encode($result));
}



?>