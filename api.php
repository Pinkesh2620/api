<?php


$tempname = $_FILES['img']['tmp_name'];

$target_folder = "storage";

$target_filename = $_FILES['img']['name'];
$target_filesize = $_FILES['img']['size'];
$target_fileerror = $_FILES['img']['error'];
$target_filetype = $_FILES['img']['type'];

$target_file = $target_folder."/".basename($target_filename);


if($target_fileerror==0){   
    $file_status =  move_uploaded_file($tempname,$target_file);
}
elseif(($target_filesize > 2000000)){     
    $message = "File too large. File must be less than 2 megabytes.";
    
} 

require_once("connection.php");

$img= $_FILES['img']['name'];
$uname=  $_POST['uname'];
$pass= $_POST['pass'];
$cpass= $_POST['cpass'];
$email= $_POST['email'];
$mob= $_POST['mob'];
$birthdate= $_POST['birthdate'];
$city= $_POST['city'];
$gender= $_POST['gender'];


$query = "INSERT  INTO `$tablename`(`img`,`uname`,`pass`,`cpass`,`email`,`mob`,`birthdate`,`city`,`gender`) value('$img','$uname','$pass','$cpass','$email','$mob','$birthdate','$city','$gender')";

$result = mysqli_query($conn, $query);

if($result==1){
  $status=1;
  $message='Data insert Suuccessful';


}  
else{
    $status=0;
    $message='Something went wrong';
}

$arr=[
    'message'=>$message,
    'status'=>$status
];

echo json_encode($arr,JSON_PRETTY_PRINT);


?>