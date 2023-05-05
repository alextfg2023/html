<?php

    include 'bbdd.php';

    $email = $_POST['email'];
    $token = $token = bin2hex(random_bytes(5));

    include '../mail/mail_reset_pass.php';

    if($enviado){

        $conn->query("INSERT INTO passwords (email, token, codigo) 
        VALUES ('$email', '$token', '$codigo')") or die($conn->error);

        echo 'Verifica tu email para restablecer la contraseña';
    }
?>