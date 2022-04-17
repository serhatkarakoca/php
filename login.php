<?php 


include("config.php");

$mail = $_POST["email"];
$pass = $_POST["password"];


Class Member{
    public $uid;
    public $uname;
}

$member = new Member();

$stmp = mysqli_query($connect,"select * from users where email ='$mail'");

$control = mysqli_fetch_assoc(mysqli_query($connect,"select * from users where email ='$mail'"));

if(mysqli_num_rows($stmp)>0){
    
    $hashedPassword = $control['password'];
    if(password_verify($pass,$hashedPassword)){

        $member -> uid = $control["id"];
        $member -> uname =$control["email"];
        
        echo(json_encode($member));

    }

}

?>