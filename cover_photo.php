<?php

include("config.php");

$user_id = $_POST["user_id"];
$cover_photo = $_POST["cover_photo"];


$cover_title = rand(0,10000000).chr(rand(97,122)).rand(0,10000000).rand(0,10000000).chr(rand(97,122)).$user_id."c";

$cover_path ="cover_photos/$cover_title.jpg";

$stmp = mysqli_query($connect,"select * from profile_photos where user_id ='$user_id'");
$control = mysqli_fetch_assoc(mysqli_query($connect,"select * from profile_photos where user_id ='$user_id'"));
if(mysqli_num_rows($stmp)>0){

    file_put_contents($cover_path,base64_decode($cover_photo));
    $id =$control["id"];
    $update = mysqli_query($connect,"UPDATE profile_photos SET cover_photo='$cover_path' WHERE id='$id'");
    $result->result = "updated";
    $result->tf=true;
    echo(json_encode($result));
}
else{
    file_put_contents($cover_path,base64_decode($cover_photo));
    $addUser = mysqli_query($connect,"insert into profile_photos(cover_photo,user_id) values ('$cover_path','$user_id')");
    $result->result = "uploaded";
    $result->tf=false;
    echo(json_encode($result));
}

?>