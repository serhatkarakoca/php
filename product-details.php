<?php

include("config.php");

$product_id = $_GET["product_id"];

class Result{
    public $user_id;
    public  $product_id;
    public $price;
    public $image;
    public  $title;
    public $description;
    public $cover;
    public  $tf;
    public $count;
    public $address;
    public $latitude;
    public $longitude;
    public $city;
    public $state;
    public $postalCode;
    public $country;
    public $username;
    public  $result;
}


$result = new Result();

$query = mysqli_query($connect,"select c.*,p.*,b.*,u.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 limit 1) join Adresses as b on b.product_id = c.id join users as u on u.id = c.user_id where c.id ='$product_id'");
$size = mysqli_num_rows($query);
$counter = 0;

if($size > 0){
    echo("[");
    
        while($pass = mysqli_fetch_assoc($query)){
            $counter =  $counter+1;
            $result->user_id =$pass["user_id"];
            $result->product_id=$pass["product_id"];
            $result->price=$pass["price"];
            $result->image=$pass["image_path"];
            $result->title=$pass["title"];
            $result->description=$pass["description"];
            $result->cover=$pass["cover"];
            $result->tf = true;
            $result->count = $size;
            $result->address = $pass["address"];
            $result->latitude = $pass["latitude"];
            $result->longitude = $pass["longtitude"];
            $result->city = $pass["city"];
            $result->state = $pass["state"];
            $result->postalCode = $pass["postal_code"];
            $result ->country =$pass["country"];
            $result ->username =$pass["username"];
            $result->result="ilan var";
            echo(json_encode($result));
    
            if($size>$counter){
                echo(",");
            }
        }
       echo("]");
    
    }







?>