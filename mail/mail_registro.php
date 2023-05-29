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
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $codigo = '';
    for ($i = 0; $i < 8; $i++) {
      $codigo .= $characters[rand(0, strlen($characters) - 1)];
    }
  
    // Añadir un número aleatorio a una posición aleatoria del código
    $number = rand(0, 9);
    $position = rand(0, 7);
    $codigo[$position] = $number;
  
    // Insertar un guión en la mitad del código
    $codigo = substr_replace($codigo, '-', 4, 0);

    return $codigo;
}

$usuario = htmlentities($_POST['username']);
$nombre = htmlentities($_POST['nombre']);
$email = htmlentities($_POST['email']);
$subject = $palabras['envio_mail']['registro']['subject'];
$codigo = generarCodigoRandom();
$mensaje = '
<html>
    <head>
        <title>
        </title>
    </head>
    <body>
        <p>'.$palabras['envio_mail']['registro']['saludo'].' '.$usuario.', '.$palabras['envio_mail']['registro']['codigo_verif'].'</p>
        <h2>'.$codigo.'</h2>
        <p>
        '.$palabras['envio_mail']['registro']['enlace'].' '.'<a href="timerlab.ddns.net/email.confirm/confirm.php?email='.$email.'">timerlab.ddns.net/email.confirm/confirm.php?email='.$email.'</a>
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
    $mail->addAddress ($email);
    $mail->Subject = ($subject);
    $mail->Body = ($mensaje);
    $mail->send();

$enviado = false;
if ($mail){
    $enviado = true;
}