<?php

include 'config.php';

if(isset($_POST['submit'])){
    
    $img = $_FILES['img']['name'];
    $image_size = $_FILES['img']['size'];
    $image_tmp_name = $_FILES['img']['tmp_name'];
    $image_folder = 'storage/'.$img;
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpass']));
   $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $dob = mysqli_real_escape_string($conn, $_POST['dob']);

   

   $select = mysqli_query($conn, "SELECT * FROM `registration` WHERE email = '[$email]' AND pass = '[$pass]'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `registration`(`img`, `username`, `email`, `pass`, `cpass`, `mobile`, `gender`, `city`, `dob`) VALUES ('$img','$username','$email','$pass','$cpass','$mobile','$gender','$city','$dob')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="logo" id="logo">
        <img src="download.png" alt="">
      <input type="file" name="img" id="img"  accept="img/jpg, img/jpeg, img/png">
      </div>
      <input type="text" name="username" placeholder="enter username" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="pass" placeholder="enter password" class="box" required>
      <input type="password" name="cpass" placeholder="confirm password" class="box" required>
      <input type="number" name="mobile" placeholder="enter mobile" class="box" required>
      <!-- <input type="text" name="gender" placeholder="enter gender" class="box" required> -->
      <!-- <input type="radio" name="gender" placeholder="enter gender" class="box" required>
      <label for="">Male</label>
      <input type="radio" name="gender" placeholder="enter gender" class="box" required>
      <label for="">Female</label> -->
      
      <!-- <input type="radio" name="gen">Male <input type="radio" name="gen">Female -->
      <div class="box">
               
                <div class="d-flex align-items-center mt-2">
                    <label class="option">
                        <input type="radio" name="gender" value="male" name="radio">Male
                        <span class="checkmark"></span>
                    </label>
                    <label class="option ms-4">
                        <input type="radio" name="gender" value="female" name="radio">Female
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
      <input type="text" name="city" placeholder="enter city" class="box" required>
      <input type="text" name="dob" placeholder="enter dob" class="box" required>


      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
<script>
    const image = document.querySelector("img"),
        input = document.querySelector("input");

    input.addEventListener("change", () => {
        image.src = URL.createObjectURL(input.files[0]);
    });


    var imageinput = document.getElementById("img");

    var logo = document.getElementById("logo");
    logo.addEventListener("click", () => {

        imageinput.click()
        });
</script>
</html>