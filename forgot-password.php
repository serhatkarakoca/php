<?php

include "config.php";

$mail = $_POST["email"];
$pass =$_POST["password"];
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

$stmp = mysqli_query($connect,"select * from users where email ='$mail'");

class Result{
    
    public $result;
    public $tf;

}
$result = new Result();
$control = mysqli_fetch_assoc(mysqli_query($connect,"select * from users where email ='$mail'"));

if(mysqli_num_rows($stmp)>0){
    
    $id =$control["id"];

    $update = mysqli_query($connect,"UPDATE users SET password='$hashedPassword' WHERE id='$id'");

    if($update){
       
        $result->tf=true;
        $result->result="Sifre Degistirildi.";
        echo(json_encode($result));

        
    }

}



?>