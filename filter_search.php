<?php

include("config.php");

$searchTitle = $_GET["search"];
$city = isset($_GET['city']) ? $_GET['city'] : 0;
$priceMin = isset($_GET['pricemin']) ? $_GET['pricemin'] : "asd";
$priceMax = isset($_GET['pricemax']) ? $_GET['pricemax'] : "asd";

$counter = 0;
$array = array();

if($city != 0 && $priceMin != "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%' and a.city = '$city' and c.price between $priceMin and $priceMax");
}
else if($city != 0 && $priceMin == "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%' and a.city = '$city'");
}
else if($city == 0 && $priceMin != "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%' and c.price between $priceMin and $priceMax");
  }
else if($city != 0 && $priceMin != "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%' and a.city = '$city' and c.price between $priceMin and 1000000000");
}
else if($city != 0 && $priceMin == "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%' and a.city = '$city' and c.price between 0 and $priceMax");
}
else if($city == 0 && $priceMin == "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%'  and c.price between 0 and $priceMax");
}
else if($city == 0 && $priceMin != "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%'  and c.price between $priceMin and 100000000");
}
else {
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from `products` as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.description or c.title LIKE '%$searchTitle%'");
}


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


$size = mysqli_num_rows($query);
if($size>0){
    
    while($pass = mysqli_fetch_assoc($query)){
        $result = new Result();
        $result->user_id =$pass["user_id"];
        $result->product_id=$pass["product_id"];
        $result->price=$pass["price"];
        $result->image=$pass["image_path"];
        $result ->username =$pass["username"];
        $result->title=$pass["title"];
        $result->description=$pass["description"];
        $result->tf = true;
        $result->result="ilan var";
        $array[$counter] = $result;
        $counter = $counter+1;

    }

}

echo(json_encode($array,JSON_UNESCAPED_UNICODE));





?>