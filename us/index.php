<?php

include './PHP/bbdd.php';
session_start();

if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: login.php");
    }

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $id = $row['id'];
    $bienvenida = "Welcome <b>".$row['nombre']."</b>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TimerLab</title>
</head>
<body>
    <p><?php echo $bienvenida ?></p>
    <br>
    <a href="profiles.php?id=<?php echo $id; ?>">Go my profile</a>
</body>
</html>