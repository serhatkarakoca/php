<?php

include("config.php");

$user_id = $_GET["user_id"];


class Result{
    public $user_id;
    public  $product_id;
    public $price;
    public $image;
    public  $title;
    public $description;
    public $username;
    public  $tf;
    public  $result;
}


$result = new Result();


$stmp = mysqli_query($connect,"select u.username,k.*,c.*,p.image_path from favorite_products as c join product_images as p on p.id = (
select p1.id from product_images as p1 where c.product_id = p1.product_id limit 1 )
join products as k on k.id = c.product_id join users as u on u.id=k.user_id where c.user_id='$user_id'");

$size = mysqli_num_rows($stmp);
$counter = 0;
echo("[");
if($size>0){
    while($pass = mysqli_fetch_assoc($stmp)){

        $counter = $counter+1;
        $result->user_id =$pass["user_id"];
        $result->product_id=$pass["product_id"];
        $result->price=$pass["price"];
        $result->image=$pass["image_path"];
        $result ->username =$pass["username"];
        $result->title=$pass["title"];
        $result->description=$pass["description"];
        $result->tf = true;
        $result->result="ilan var";
        echo(json_encode($result,JSON_UNESCAPED_UNICODE));
    
        if(($size)>$counter){
                echo(",");
        }
    }
}

echo("]");

?>