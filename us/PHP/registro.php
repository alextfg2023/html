<?php

include './bbdd.php';

if(isset($_POST['submit'])){

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $cemail = $_POST['cemail'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $tipo = $_POST['tipo_usuario'];
    $fecha_reg = date('Y-m-d H:i:s');
    
    $res = $conn->query("SELECT * FROM usuarios WHERE email = '$email' ") or die($conn->$error);

    if(mysqli_num_rows($res) > 0){

        $error[] = 'This email is already in use!';

    }elseif($pass != $cpass){

        $error[] = 'Paswords do not match!';

    }elseif($email != $cemail){

        $error[] = 'Emails do not match!';

    }else{

        include "./mail/mail.php";

        if($enviado){

            $conn->query("INSERT INTO usuarios (nombre, email, password, tipo, confirmado, codigo, imagen, fecha_registro) 
            VALUES ('$nombre', '$email', '$pass', '$tipo', 'no', '$codigo', '', '$fecha_reg') ")or die($conn->$error);

            echo "Please check your mailbox and verify your account before logging in.";

        }else{

            echo 'Verification email could not be sent';
        }
    }
}

?>
<!DOCTYPE html>
<head>
    <title>Sign Up - TimerLab</title>
</head>
<body>
    <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<b><p>'.$error.'</p></b>';
            };
        };
    ?>
</body>
</html>