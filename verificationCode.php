<?php

include "config.php";


$userCode =$_POST["code"];
$mail =$_POST["email"];
$stmp = mysqli_query($connect,"select * from users where email ='$mail'");


class Result{
    
    public $result;
    public $tf;

}
$result = new Result();

$control = mysqli_fetch_assoc(mysqli_query($connect,"select * from users where email ='$mail'"));
if(mysqli_num_rows($stmp)>0){  

    $code = $control["code"];
    $id =$control["id"];
    if($code==$userCode){
        $code=null;
        $update = mysqli_query($connect,"UPDATE users SET code='$code' WHERE id='$id'");
        $result->tf=true;
        $result->result="Mail onayi tamamlandi";
        echo(json_encode($result));
    }


}



?>