<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["request"])){
    $mail = new PHPMailer(true);
    $mail -> isSMTP();
    $mail -> Host = "smtp.gmail.com";
    $mail -> SMTPAuth = true;
    $mail -> Username = 'verify123456789123@gmail.com';
    $mail -> Password = 'sxdjrzbfmibfcxes';
    $mail -> SMTPSecure = 'ssl';
    $mail -> Port = 465;

    $mail->setFrom('verify123456789123@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);
    $mail->Subject = "verfication";

    $randomNumber = mt_rand(100000,999999);
    $mail->Body = $randomNumber;

    // Set session variables
    $_SESSION['randomNumber'] = $randomNumber;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['pass'];
    $_SESSION['image'] = $_FILES['image']['name'];

    $mail->send();

    echo 
    "
    <script>
    alert('sent successfully');
    document.location.href = 'verifyphp.php';
    </script>
    ";
}
?>
