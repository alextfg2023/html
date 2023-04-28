<?php

    include "./bbdd.php";
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    $res = $conn->query("SELECT * FROM usuarios 
            WHERE email = '$email' 
            AND codigo = '$codigo'") or die($conn->$error);
    if(mysqli_num_rows($res) > 0){
        echo "Your email have been verified!<br>";
        $conn->query("UPDATE usuarios SET confirmado = 'si' WHERE email = '$email'");
        echo "You can now <a href='../login.php'>Log in</a>";
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
    <title>Account Verificated - TimerLab</title>
</head>
<body>
</body>
</html>