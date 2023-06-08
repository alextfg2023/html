<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include '../idiomas/idiomas.php';

function generarCodigoRandom() {

    // Genera código de seis caracteres para verificar el correo
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $codigo = '';
    for ($i = 0; $i < 8; $i++) {
      $codigo .= $characters[rand(0, strlen($characters) - 1)];
    }
  
    // Añade un número aleatorio a una posición aleatoria del código
    $number = rand(0, 9);
    $position = rand(0, 7);
    $codigo[$position] = $number;
  
    // Inserta un guión en la mitad del código
    $codigo = substr_replace($codigo, '-', 4, 0);

    return $codigo;
}
$usuario = htmlentities($_POST['username']);
$nombre = htmlentities($_POST['nombre']);
$email = htmlentities($_POST['email']);
$emailmsg = md5($email);
$subject = $palabras['envio_mail']['registro']['subject'];
$codigo = generarCodigoRandom();
$mensaje = '
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <style>
            * {
                margin: 0;
                padding: 0;
                list-style: none;
                box-sizing: border-box;
                text-rendering: none;
                font-family: "Poppins", sans-serif;
            }
            
            .content {
                width: 100%;
                height: 60vh;
                background: #FFF9F3;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .msg{
                width: 450px;
                height: 85%;
                background: #fff;
                border-radius: 15px;
                position: absolute;
                margin-bottom: 4%;
                margin-top: 4%;
                margin-left: 35%;
                transform: translate(-80%, -80%);
                text-align: center;
                padding: 0 30px 30px;
                color: #333;
                border: 2px solid #FEE7DE;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }

            .msg .logo {
                color: #CE967B;
            }

            .msg h1 {
                color: black;
                font-size: 40px;
                font-weight: 500;
                margin: 30px 0 10px;
            } 

            .msg h2 {
                color: black;
                font-size: 30px;
                font-weight: 500;
                margin: 30px 0 10px;
            }
            
            .msg .boton {
                display: block;
                margin-top: 50px;
                padding: 10px 0;
                background: #CE967B;
                color: #fff;
                text-decoration: none;
                font-size: 18px;
                border-radius: 4px;
                cursor: pointer;
                box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
            }
            
            .msg .boton:hover {
                background: #EBAD8D;
            }

            @media(max-width: 584px){

                .content {
                    width: 100%;
                    height: 100%;
                    background: #FFF9F3;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                
                .msg{
                    width: 450px;
                    height: 99%;
                    background: #fff;
                    border-radius: 15px;
                    position: absolute;
                    margin: 6% 4% 4% 4%;
                    transform: translate(-80%, -80%);
                    text-align: center;
                    padding: 0 30px 30px;
                    color: #333;
                    border: 2px solid #FEE7DE;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                }
    
                .msg h1 {
                    color: black;
                    font-size: 40px;
                    font-weight: 500;
                    margin: 30px 0 10px;
                } 
    
                .msg h2 {
                    color: black;
                    font-size: 30px;
                    font-weight: 500;
                    margin: 30px 0 10px;
                }
                
                .msg .boton {
                    display: block;
                    margin-top: 50px;
                    padding: 10px 0;
                    background: #CE967B;
                    color: #fff;
                    text-decoration: none;
                    font-size: 18px;
                    border-radius: 4px;
                    cursor: pointer;
                    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
                }    
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="msg"> 
                <h2 class="logo">'.$palabras['envio_mail']['logo'].'</h2>
                <h1>'.$palabras['envio_mail']['registro']['saludo'].' '.$nombre.'!</h1>
                <b><h2>'.$codigo.'</h2><b>
                <p>'.$palabras['envio_mail']['registro']['codigo_verif'].'</p>
                <br>
                <p>'.$palabras['envio_mail']['registro']['enlace'].'<a href="timerlab.ddns.net/email.confirm/confirm.php?email='.$email.'">timerlab.ddns.net/email.confirm/confirm.php?email='.$emailmsg.'</a></p>
                <a class="boton" href="timerlab.ddns.net/email.confirm/confirm.php?email='.$email.'">'.$palabras['envio_mail']['registro']['boton'].'</a>
            </div>
        </div>
    </body>
</html>';



/*$mensaje = '
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <style>
            * {
                margin: 0;
                padding: 0;
                list-style: none;
                box-sizing: border-box;
                text-rendering: none;
                font-family: "Poppins", sans-serif;
            }
            
            .content {
                width: 100%;
                height: 60vh;
                background: #FFF9F3;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .msg{
                width: 450px;
                height: 70%;
                background: #fff;
                border-radius: 15px;
                position: absolute;
                margin-bottom: 4%;
                margin-top: 4%;
                margin-left: 35%;
                transform: translate(-80%, -80%);
                text-align: center;
                padding: 0 30px 30px;
                color: #333;
                border: 2px solid #FEE7DE;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            }

            .msg h1 {
                color: black;
                font-size: 40px;
                font-weight: 500;
                margin: 30px 0 10px;
            } 

            .msg h2 {
                color: black;
                font-size: 30px;
                font-weight: 500;
                margin: 30px 0 10px;
            }
            
            .msg .boton {
                display: block;
                margin-top: 50px;
                padding: 10px 0;
                background: #CE967B;
                color: #fff;
                text-decoration: none;
                font-size: 18px;
                border-radius: 4px;
                cursor: pointer;
                box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
            }
            
            .msg .boton:hover {
                background: #EBAD8D;
            }

            @media(max-width: 584px){
                .msg{
                    width: 450px;
                    height: 90%;
                    background: #fff;
                    border-radius: 15px;
                    position: absolute;
                    margin: 6% 4% 4% 4%;
                    transform: translate(-80%, -80%);
                    text-align: center;
                    padding: 0 30px 30px;
                    color: #333;
                    border: 2px solid #FEE7DE;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                }
    
                .msg h1 {
                    color: black;
                    font-size: 40px;
                    font-weight: 500;
                    margin: 30px 0 10px;
                } 
    
                .msg h2 {
                    color: black;
                    font-size: 30px;
                    font-weight: 500;
                    margin: 30px 0 10px;
                }
                
                .msg .boton {
                    display: block;
                    margin-top: 50px;
                    padding: 10px 0;
                    background: #CE967B;
                    color: #fff;
                    text-decoration: none;
                    font-size: 18px;
                    border-radius: 4px;
                    cursor: pointer;
                    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
                }    
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="msg"> 
                <h1>'.$palabras['envio_mail']['registro']['saludo'].' '.$nombre.'!</h1>
                <b><h2>'.$codigo.'</h2><b>
                <p>'.$palabras['envio_mail']['registro']['codigo_verif'].'</p>
                <br>
                <p>'.$palabras['envio_mail']['registro']['enlace'].'<a href="timerlab.ddns.net/email.confirm/confirm.php?email='.$email.'">timerlab.ddns.net/email.confirm/confirm.php?email='.$emailmsg.'</a></p>
                <a class="boton" href="timerlab.ddns.net/email.confirm/confirm.php?email='.$email.'">'.$palabras['envio_mail']['registro']['boton'].'</a>
            </div>
        </div>
    </body>
</html>';*/


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Timer.Lab.Verify@gmail.com';
    $mail->Password = 'dpkrrxnewlgxenud';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('Timer.Lab.Verify@gmail.com', 'TimerLab');
    $mail->addAddress ($email);
    $mail->Subject = ($subject);
    $mail->Body = ($mensaje);
    $mail->send();

$enviado = false;
if ($mail){
    $enviado = true;
}