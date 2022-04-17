<?php 
header('Content-Type: application/json');
include("config.php");

$mail =$_POST['email'];
$pass =$_POST['password'];
$name =$_POST['first_name'];
$surname =$_POST['last_name'];

$verfcode = rand(0,10000);
$status = 0;
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

class Result{
    
    public $result;
    public $tf;
    public $verificationCode;
}

$result = new Result();

$control = mysqli_query($connect,"select * from users where email ='$mail'");

if(mysqli_num_rows($control)<1){
    $username = strtok($mail,'@');
    $controlUserName = mysqli_query($connect,"select * from users where username ='$username'");
    while(mysqli_num_rows($controlUserName)>0){
         $username = strtok($mail,'@').rand(0,1000);
    $controlUserName = mysqli_query($connect,"select * from users where username ='$username'");
    }
    if(mysqli_num_rows($controlUserName)<1){
    $addUser = mysqli_query($connect,"insert into users(first_name,last_name,email,password,code,status,username) values ('$name','$surname','$mail','$hashedPassword','$verfcode','$status','$username')");
    if($addUser){
        
        $result->verificationCode =strval($verfcode);
        $result->tf=true;
        $result->result="Registration Successful";
        echo(json_encode($result));
         
        }
    }
}
else{
    
    $result->result="account already exists";
    $result->tf = false;
    echo(json_encode($result));
     
    
}

?>