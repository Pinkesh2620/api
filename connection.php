<?php
$hostname = "localhost";
$user ="id20877840_webapi";
$dbpass ="Hd@17012904";
$dbname = "id20877840_webapi";
$tablename = "registration";

$conn = mysqli_connect($hostname,$user,$dbpass,$dbname) or die("CONECTION ...");

    if($conn){
        
    }
    else{
        echo "connection not working..";
}

?>