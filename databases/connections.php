<?php
    include_once 'config/config.php';

   try {

    $connect = mysqli_connect($host,$username,$password,$db_name);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
   } catch (\Throwable $th) {
        die("ERROR IS ". $th);
   }

    


//    $connect->close();



?>