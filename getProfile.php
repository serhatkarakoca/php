<?php

include("config.php");

$user_id = $_GET["user_id"];

$query = mysqli_query($connect,"select * from users where id = '$user_id'");
$imagesQuery = mysqli_query($connect,"select * from profile_photos where user_id = '$user_id'");


class Result{

    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $profile_photo;
    public $cover_photo;
    
}

$result = new Result();



if(mysqli_num_rows($query)>0){

    $pass = mysqli_fetch_assoc($query);

    if(mysqli_num_rows($imagesQuery)>0){
        $passImages = mysqli_fetch_assoc($imagesQuery);

            $result->first_name = $pass["first_name"];
            $result->last_name = $pass["last_name"];
            $result->username = $pass["username"];
            $result->email = $pass["email"];
            $result->profile_photo = $passImages["profile_photo"];
            $result->cover_photo = $passImages["cover_photo"];
            echo(json_encode($result));
    }
    else{
            $result->first_name = $pass["first_name"];
            $result->last_name = $pass["last_name"];
            $result->username = $pass["username"];
            $result->email = $pass["email"];
            echo(json_encode($result));
    }

}



?>