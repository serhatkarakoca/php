<?php 

include("config.php");

$user_id = $_GET["user_id"];
$cover = 1;

$query = mysqli_query($connect,"select c.*,p.*,u.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 limit 1) join users as u on u.id = c.user_id where c.user_id = '$user_id'");

class Result{
    public $user_id;
    public  $product_id;
    public $price;
    public $image;
    public  $title;
    public $username;
    public $description;
    public  $tf;
    public  $result;
}


$result = new Result();

$size = mysqli_num_rows($query);

if($size > 0){
    $counter =0;
    echo("[");
    while($pass = mysqli_fetch_assoc($query)){
        $counter += 1;
        $result->user_id =$user_id;
        $result->product_id=$pass["product_id"];
        $result->price=$pass["price"];
        $result->image=$pass["image_path"];
        $result->title=$pass["title"];
        $result->username=$pass["username"];
        $result->description=$pass["description"];
        $result->tf = true;
        $result->result="ilan var";
        echo(json_encode($result));
        
        if($size>$counter){
            echo(",");
        }

    }
    echo("]");
}

?>