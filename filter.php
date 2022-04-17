<?php

include("config.php");

$gid = $_GET["id"];
$city = isset($_GET['city']) ? $_GET['city'] : 0;
$priceMin = isset($_GET['pricemin']) ? $_GET['pricemin'] : "asd";
$priceMax = isset($_GET['pricemax']) ? $_GET['pricemax'] : "asd";

$kod="SELECT * FROM `categories` WHERE id = '$gid'";
$pkod = "Select * From `products` ";
  
$sqlor=mysqli_query($connect,$kod);
$size = mysqli_num_rows($sqlor);
$data=mysqli_fetch_assoc($sqlor);

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
    
    if($gid == 0){
      getAllProducts($connect);
    }
    else if($data["pid"] == 0){
      getMainCategories($gid,$connect,$city,$priceMin,$priceMax);
    }
    
    else {
      getFilter($gid,$connect,$city,$priceMin,$priceMax);
    }
function getMainCategories($gid,$connect,$city,$priceMin,$priceMax){
  
  $pkod = "Select * From `products` ";
  $sqlpro = mysqli_query($connect,$pkod);
  $array = array();     
  $counter = 0;
        while($data2 =mysqli_fetch_assoc($sqlpro)){
      
    $pci = $data2["category"];
 
  $kod="SELECT * FROM `categories` WHERE id = '$pci'";
    
  $sqlor=mysqli_query($connect,$kod);
 
  $data1=mysqli_fetch_assoc($sqlor);
  
     
      
  while($data1["pid"]!=0){
      $kod="SELECT * FROM `categories` WHERE id = '$pci'";
      $sqlor=mysqli_query($connect,$kod);
      $data1=mysqli_fetch_assoc($sqlor);
      
  if($data1["pid"]==0){
      
    if($data1["id"]==$gid){
        $result = new Result();
        $pro = $data2["id"];
        if($city != 0 && $priceMin != "asd" && $priceMax != "asd"){
          $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between $priceMin and $priceMax");
        }
        else if($city != 0 && $priceMin == "asd" && $priceMax == "asd"){
          $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city");
      }
      else if($city == 0 && $priceMin != "asd" && $priceMax != "asd"){
        $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between $priceMin and $priceMax");
      }
      else if($city != 0 && $priceMin != "asd" && $priceMax == "asd"){
        $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between $priceMin and 1000000000");
      }
      else if($city != 0 && $priceMin == "asd" && $priceMax != "asd"){
        $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between 0 and $priceMax");
      }
      else if($city == 0 && $priceMin == "asd" && $priceMax != "asd"){
        $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between 0 and $priceMax");
      }
      else if($city == 0 && $priceMin != "asd" && $priceMax == "asd"){
        $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between $priceMin and 1000000000");
      }
      else {
        $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id ");
      }
        
       
        while($pass = mysqli_fetch_assoc($query)){
                  
            $result->user_id =$pass["user_id"];
            $result->product_id=$pass["product_id"];
            $result->price=$pass["price"];
            $result->image=$pass["image_path"];
            $result->username=$pass["username"];
            $result->title=$pass["title"];
            $result->description=$pass["description"];
            $result->tf = true;
            $result->result="ilan var";
            $array[$counter] = $result;
            $counter = $counter+1;
            
             
        }
        
        
    }
     
     
  }
  else{
      $pci=$data1["pid"];
    
  }
        }
        }
       echo(json_encode($array,JSON_UNESCAPED_UNICODE));  
}

function getFilter($gid,$connect,$city,$priceMin,$priceMax){
  $array = array();
  $counter = 0;
  $pkod = "Select * From `products` ";
  $sqlpro = mysqli_query($connect,$pkod);
       
      while($data2 =mysqli_fetch_assoc($sqlpro)){
      
    $pci = $data2["category"];
 
  $kod="SELECT * FROM `categories` WHERE id = '$pci'";
    
  $sqlor=mysqli_query($connect,$kod);
 
  $data1=mysqli_fetch_assoc($sqlor);
  if($data1["pid"]==$gid){
    
    $pro = $data2["id"];
    if($city != 0 && $priceMin != "asd" && $priceMax != "asd"){
      $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between $priceMin and $priceMax");
    }
    else if($city != 0 && $priceMin == "asd" && $priceMax == "asd"){
      $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city");
  }
  else if($city == 0 && $priceMin != "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between $priceMin and $priceMax");
  }
  else if($city != 0 && $priceMin != "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between $priceMin and 1000000000");
  }
  else if($city != 0 && $priceMin == "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between 0 and $priceMax");
  }
  else if($city == 0 && $priceMin == "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between 0 and $priceMax");
  }
  else if($city == 0 && $priceMin != "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between $priceMin and 1000000000");
  }
  else {
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id ");
  }
    $result = new Result();
    while($pass = mysqli_fetch_assoc($query)){
     
      $result->user_id =$pass["user_id"];
      $result->product_id=$pass["product_id"];
      $result->price=$pass["price"];
      $result->image=$pass["image_path"];
      $result->username=$pass["username"];
      $result->title=$pass["title"];
      $result->description=$pass["description"];
      $result->tf = true;
      $result->result="ilan var";
      $array[$counter] = $result;
      $counter = $counter+1;
 
}
 
  }   
  else if($data1["id"]==$gid){
   
    $pro = $data2["id"];
    if($city != 0 && $priceMin != "asd" && $priceMax != "asd"){
      $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between $priceMin and $priceMax");
    }
    else if($city != 0 && $priceMin == "asd" && $priceMax == "asd"){
      $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city");
  }
  else if($city != 0 && $priceMin != "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between $priceMin and 1000000000");
  }
  else if($city != 0 && $priceMin == "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where a.city = $city and c.price between 0 and $priceMax");
  }
  else if($city == 0 && $priceMin == "asd" && $priceMax != "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between 0 and $priceMax");
  }
  else if($city == 0 && $priceMin != "asd" && $priceMax == "asd"){
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id where c.price between $priceMin and 1000000000");
  }
  else {
    $query = mysqli_query($connect,"select c.*,p.*,u.*,a.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id join Adresses as a on a.product_id = c.id ");
  }
    $result = new Result();
    while($pass = mysqli_fetch_assoc($query)){
     
      $result->user_id =$pass["user_id"];
      $result->product_id=$pass["product_id"];
      $result->price=$pass["price"];
      $result->image=$pass["image_path"];
      $result->username=$pass["username"];
      $result->title=$pass["title"];
      $result->description=$pass["description"];
      $result->tf = true;
      $result->result="ilan var";
      $array[$counter] = $result;
      $counter = $counter+1;
}
 
  }
 
        }
        echo(json_encode($array,JSON_UNESCAPED_UNICODE)); 
}

function getAllProducts($connect){
  $query = mysqli_query($connect,"select c.*,p.*,u.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 limit 1) join users as u on u.id = c.user_id");
  $array = array();
  $counter = 0;

  while($pass = mysqli_fetch_assoc($query)){
    $result = new Result();                
    $result->user_id =$pass["user_id"];
    $result->product_id=$pass["product_id"];
    $result->price=$pass["price"];
    $result->image=$pass["image_path"];
    $result->username=$pass["username"];
    $result->title=$pass["title"];
    $result->description=$pass["description"];
    $result->tf = true;
    $result->result="ilan var";
    $array[$counter] = $result;
    $counter = $counter+1;
    
     
}
echo(json_encode($array,JSON_UNESCAPED_UNICODE)); 
}

?>