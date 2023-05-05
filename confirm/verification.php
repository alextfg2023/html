<?php
session_start();
include '../idiomas/idiomas.php'; 
include "../complementosPHP/bbdd.php";
$email = $_POST['email'];
$codigo = $_POST['codigo'];

$res = $conn->query("SELECT * FROM usuarios WHERE email = '$email' AND codigo = '$codigo'") or die($conn->$error);

if(mysqli_num_rows($res) > 0){

    echo $palabras['verificacion']['verify_ok'].' '."<a href='../website/login.php'>".$palabras['verificacion']['log_in']."</a>";
    
    $conn->query("UPDATE usuarios SET confirmado = 'si' WHERE email = '$email'");

}else{
    echo $palabras['verificacion']['verify_error'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['verificacion_title'] ?></title>
</head>
<body>
</body>
</html>