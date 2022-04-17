<?php

include("config.php");

$pid = $_GET["pid"];



        
        $kod="SELECT
              K.pid,K.id, K.categoryName,
              (SELECT COUNT(A.id) FROM categories AS A WHERE A.pid=K.id ) as subCategorySize
              FROM categories AS K
              WHERE K.pid='$pid'";
              
        $sqlor=mysqli_query($connect,$kod);
        $size = mysqli_num_rows($sqlor);
        
        
    class Result{
        
        public $category;
        public $id;
        public $subCategory;
        public $pid;
    }            
       
        $result = new Result();
        
        $counter = 0;
        if($size>0){
    
        echo("[");
     while($data=mysqli_fetch_assoc($sqlor))
        {
            
                $counter = $counter+1;
                $result->category = $data["categoryName"];
                $result->id = $data["id"];
                $result->subCategory = $data["subCategorySize"];
                $result->pid = $data["pid"];
                echo(json_encode($result,JSON_UNESCAPED_UNICODE));
               if($size>$counter){
               echo(",");
               
             }
            
        }
       
        
        echo("]");
}
    


?>