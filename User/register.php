<?php
session_start();
include 'components/connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){
   $id = unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if(isset($_FILES['image']) && $_FILES['image']['name']){
       $image = $_FILES['image']['name'];
       $image = filter_var($image, FILTER_SANITIZE_STRING);
       $ext = pathinfo($image, PATHINFO_EXTENSION);
       $rename = unique_id().'.'.$ext;
       $image_size = $_FILES['image']['size'];
       $image_tmp_name = $_FILES['image']['tmp_name'];
       $image_folder = 'uploaded_files/'.$rename;

       // Move uploaded file to destination folder
       if(move_uploaded_file($image_tmp_name, $image_folder)){
           // Image upload successful
       }else{
           // Image upload failed
           $message[] = 'Failed to upload image.';
       }
   } else {
       // Handle the case where no file was uploaded
   }

   $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
   $select_user->execute([$email]);
   
   if($select_user->rowCount() > 0){
      $message[] = 'Email already taken!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         // Send verification email
         $mail = new PHPMailer(true);
         $mail->isSMTP();
         $mail->Host = "smtp.gmail.com";
         $mail->SMTPAuth = true;
         $mail->Username = 'verify123456789123@gmail.com';
         $mail->Password = 'sxdjrzbfmibfcxes';
         $mail->SMTPSecure = 'ssl';
         $mail->Port = 465;

         $mail->setFrom('verify123456789123@gmail.com');
         $mail->addAddress($email);
         $mail->isHTML(true);
         $mail->Subject = "Verification";

         $randomNumber = mt_rand(100000,999999);
         $mail->Body = $randomNumber;

         // Set session variables
         $_SESSION['randomNumber'] = $randomNumber;
         $_SESSION['name'] = $name;
         $_SESSION['email'] = $email;
         $_SESSION['password'] = $pass;
         $_SESSION['image'] = $rename;

         $mail->send();

         // Display the verification form
         echo "<style>
    .verification {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .verification label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .verification input[type='text'] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .verification button[type='submit'] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4caf50;
        color: white;
        cursor: pointer;
    }

    .verification button[type='submit']:hover {
        background-color: #45a049;
    }
</style>";

echo "<div class='verification'>
           <form method='post' action='register.php'>
              <label for='chk' aria-hidden='true'>Verification Form</label>
              <input type='text' id='userInput' name='userInput' placeholder='Enter Code' required><br>
              <button type='submit' name='verify' value='Verify'>Verify</button>
           </form>
       </div>";

         exit; // Stop further execution
      }
   }
}

if(isset($_POST['verify'])){
   $userInput = $_POST["userInput"];
   if ($userInput == $_SESSION['randomNumber']) {
      // Verification successful, insert user details into the database
      $id = unique_id();
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
      $password = $_SESSION['password'];
      $image = $_SESSION['image'];

      $insert_user = $conn->prepare("INSERT INTO users(id, name, email, password, image) VALUES (?, ?, ?, ?, ?)");
      $insert_user->execute([$id, $name, $email, $password, $image]);

      // Redirect to the home page or login page
      header('location: home.php');
      exit;
   } else {
      echo "<script>alert('Verification Failed. Try again');</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form class="register" action="register.php" method="post" enctype="multipart/form-data">
      <h3>Create Account</h3>
      <div class="flex">
         <div class="col">
            <p>Your Name <span>*</span></p>
            <input type="text" name="name" placeholder="Enter Your Name" maxlength="50" required class="box">
            <p>Your Email <span>*</span></p>
            <input type="email" name="email" placeholder="Enter Your Email" maxlength="50" required class="box">
         </div>
         <div class="col">
            <p>Your Password <span>*</span></p>
            <input type="password" name="pass" placeholder="Enter Your Password" maxlength="20" required class="box">
            <p>Confirm Password <span>*</span></p>
            <input type="password" name="cpass" placeholder="Confirm Your Password" maxlength="20" required class="box">
         </div>
      </div>
      <p>Select Picture <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <p class="link">Already have an account? <a href="login.php">Login Now</a></p>
      <input type="submit" name="submit" value="Register Now" class="btn">
   </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>
