<?php

include 'config.php';
session_start();
$id = $_SESSION['id'];

if(!isset($id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($id);
   session_destroy();
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `registration` WHERE id = '$id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['img'] == ''){
            echo '<img src="download.png">';
         }else{
            echo '<img src="storage/'.$fetch['img'].'">';
         }
      ?>
      <h3><?php echo $fetch['username']; ?></h3>
      <a href="update.php" class="btn">update profile</a>
      <a href="home.php?logout=<?php echo $id; ?>" class="delete-btn">logout</a>
      <p>new <a href="login.php">login</a> or <a href="registration.php">register</a></p>
   </div>

</div>

</body>
</html>