<?php
include("config.php");
$countryCode = $_GET["pid"];

$query = mysqli_query($connect,"select * from cities where pid = '$countryCode'");

class Result{
   public $city;
   public $id;
}
$size = mysqli_num_rows($query);
$counter = 0;
$result = new Result();
if($size>0){
    echo("[");
    while($data = mysqli_fetch_assoc($query)){
        $counter += 1;
        $result->city = $data["city"];
        $result->id = $data["id"];
        echo(json_encode($result,JSON_UNESCAPED_UNICODE));  
        if($size>$counter){
            echo(",");
        }
        else{
            echo("]");
        }
    }
}
?>