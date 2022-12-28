<?php

//composer require phpmailer/phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = true;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password     
$mail->Username = "rkteqm@gmail.com";
$mail->Password = "ggdbvypvxcfzwjif";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
$mail->Port = 587;

// $my_path = '../uploads/test.jpeg';
// if (!file_exists($my_path)) {
//     //Provide file path and name of the attachments
//     die("File Not Exist!");
// }
// $mail->addAttachment($my_path, "File.php");
$mail->From = "rkteqm@gmail.com";
$mail->FromName = "Rahul";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $id = $_POST['id'];
    // echo $email;
    // echo $id;

    $mail->addAddress($email, "TEST");

    $mail->isHTML(true);

    $mail->Subject = "Reset Password link";
    $mail->Body = "<a href='http://localhost/assignment3clone/reset.php?id=$id'>Click here </a> for reset password ";
    $mail->AltBody = "This is the plain text version of the email content";

    try {
        $mail->send();
        echo "Reset password link has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}