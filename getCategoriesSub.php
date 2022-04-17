<?php

include("config.php");
$gid = $_GET["id"];


  $kod="SELECT * FROM `categories` WHERE id = '$gid'";
  $pkod = "Select * From `products` ";
    
  $sqlor=mysqli_query($connect,$kod);
  $size = mysqli_num_rows($sqlor);

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

  $counter = 0;
  if($size>0){
 // echo("size: ".$size);
  echo("[");
  $data=mysqli_fetch_assoc($sqlor);
 
    if($data["pid"]==null){
        echo("if içi: ".$size);
  while($data=mysqli_fetch_assoc($sqlor))
  {
   
    $counter = $counter+1;
    $result->category = $data["categoryName"];
    $result->id = $data["pid"];
    echo(json_encode($result,JSON_UNESCAPED_UNICODE));
         
  }
  
    }
    else{

         $sqlpro = mysqli_query($connect,$pkod);
         //$data2 =mysqli_fetch_assoc($sqlpro);
       
       
       // echo(mysqli_num_rows($sqlpro));
        while($data2 =mysqli_fetch_assoc($sqlpro)){
       // echo("orman: ".$data2["id"]);
    $pci = $data2["category"];
 
  $kod="SELECT * FROM `categories` WHERE id = '$pci'";
    
  $sqlor=mysqli_query($connect,$kod);
 
  $data1=mysqli_fetch_assoc($sqlor);
  
     
      
  while($data1["pid"]!=0){
      $kod="SELECT * FROM `categories` WHERE id = '$pci'";
      $sqlor=mysqli_query($connect,$kod);
      $data1=mysqli_fetch_assoc($sqlor);
        $size1 = mysqli_num_rows($sqlpro);
      
  if($data1["pid"]==0){
      
    if($data1["id"]==$gid){
        $pro = $data2["id"];
        $query = mysqli_query($connect,"select c.*,p.*,u.* from products as c join product_images as p on p.id =(select p1.id from product_images as p1 where c.id = p1.product_id and p1.cover=1 and c.id = '$pro' limit 1) join users as u on u.id = c.user_id");
        while($pass = mysqli_fetch_assoc($query)){
                  $counter = $counter+1;
            $result->user_id =$pass["user_id"];
            $result->product_id=$pass["product_id"];
            $result->price=$pass["price"];
            $result->image=$pass["image_path"];
            $result->username=$pass["username"];
            $result->title=$pass["title"];
            $result->description=$pass["description"];
            $result->tf = true;
            $result->result="ilan var";
            echo(json_encode($result,JSON_UNESCAPED_UNICODE));  
             if($size1>$counter){
               echo(",");
             }
        }
  
      
    }
     
     
  }
  else{
      $pci=$data1["pid"];
    
  }
        }
        }
        
    }
  echo("]");
  }


?>