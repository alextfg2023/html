<?php

    include "./bbdd.php";
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
            WHERE email = '$email' 
            AND codigo = '$codigo'") or die($conn->$error);
    if(mysqli_num_rows($res) > 0){
        echo "Ok<br>";
        $conn->query("UPDATE usuarios SET confirmado = 'si' WHERE email = '$email'");
        echo "Ya puedes <a href='./login.php'>iniciar sesión</a>";
    }else{
        echo "error";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Verificada - TimerLab</title>
</head>
<body>
</body>
</html>