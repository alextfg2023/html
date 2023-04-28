<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$codigo = rand(10000,99999);

$nombre = htmlentities($_POST['nombre']);
$email = htmlentities($_POST['email']);
$subject = 'Verify your account in TimerLab!';
$mensaje = '
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <p>Verification code:</p>
        <h2>'.$codigo.'</h2>
        <p>
            Go to this link and verify your account: <a href="https://timerlab.es/us/confirm.php?email='.$email.'">https://timerlab.es/us/confirm.php?email='.$email.'</a>
        </p>
    </body>
</html>';


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Timer.Lab.Verify@gmail.com';
    $mail->Password = 'dpkrrxnewlgxenud';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('Timer.Lab.Verify@gmail.com', 'Timer_Lab');
    $mail->addAddress($email);
    $mail->Subject = ($subject);
    $mail->Body = ($mensaje);
    $mail->send();

$enviado = false;
if ($mail){
    $enviado = true;
}