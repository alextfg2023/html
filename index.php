<?php

include 'bbdd.php';
session_start();

if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: login.php");
    }

$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $id = $row['id'];
    $bienvenida = "Bienvenid@ <b>".$row['nombre']."</b>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><?php echo $bienvenida ?></p>
    <a href="tabladesglose.php">Ver mis horarios</a>
    <br>
    <br>
    <a href="perfil.php?id=<?php echo $id; ?>">Ir a mi perfil</a>
</body>
</html>