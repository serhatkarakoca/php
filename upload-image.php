<?php

include ("config.php");

class Result{
    public $result;
    public $tf;
}

$result = new Result();

$user_id = $_POST["user_id"];
$product_id = $_POST["product_id"];
$image = $_POST["image"];
$cover = $_POST["cover"];


$image_title = rand(0,10000000).chr(rand(97,122)).rand(0,10000000).rand(0,10000000).chr(rand(97,122)).$user_id.$product_id;
$control = mysqli_query($connect,"select * from product_images where image_title ='$image_title'");

$image_path ="app-images/$image_title.jpg";

$add = mysqli_query($connect,"insert into product_images(user_id,product_id,image_title,image_path,cover) values ('$user_id','$product_id','$image_title','$image_path','$cover')");

if($add){
    file_put_contents($image_path,base64_decode($image));
    $result->result = "Resim yuklendi";
    $result->tf = true;
    echo(json_encode($result));
    }


?>