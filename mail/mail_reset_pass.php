<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include '../idiomas/idiomas.php';

function generarCodigoRandom() {
    // Generar un código de seis caracteres
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&*';
    $codigo = '';
    for ($i = 0; $i < 20; $i++) {
      $codigo .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $codigo;
}

$titulo = 'Restablecer password TimerLab';
$codigo = generarCodigoRandom();

$email = htmlentities($_POST['email']);
$subject = $palabras['envio_mail']['reset_pass']['subject'];
$mensaje = '
<html>
<head>
  <title>Restablecer</title>
</head>
<body>
    <h1>TimerLab</h1>
    <div style="text-align:center; background-color:#ccc">
        <p>Restablecer contraseña</p>
        <h3>'.$codigo.'</h3>
        <p>Para restablecer tu contraseña haz <a href="https://timerlab.es/password.reset/code.confirm.php?email='.$email.'&token='.$token.'">
        click aquí</a></p>
        <p> <small>Si no solicitó este codigo por favor omita el mensaje</small> </p>
    </div>
</body>
</html>
';


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
    $mail->addAddress ($email);
    $mail->Subject = ($subject);
    $mail->Body = ($mensaje);
    $mail->send();

$enviado = false;
if ($mail){
    $enviado = true;
}