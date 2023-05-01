<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include '../idiomas/idiomas.php';

$codigo = rand(100000,9999999);

$nombre = htmlentities($_POST['nombre']);
$email = htmlentities($_POST['email']);
$subject = $palabras['envio_mail']['subject'];
$mensaje = '
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <p>'.$palabras['envio_mail']['codigo_verif'].'</p>
        <h2>'.$codigo.'</h2>
        <p>
        '.$palabras['envio_mail']['enlace'].' '.'<a href="https://timerlab.es/confirm.php?email='.$email.'">https://timerlab.es/confirm.php?email='.$email.'</a>
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