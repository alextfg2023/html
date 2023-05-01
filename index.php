<?php

include './bbdd.php';
session_start();

if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: login.php");
    }

    include './idiomas/idiomas.php'; 


$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $nombre = $row['nombre'];
    $id = $row['id'];
    $sexo = $row['sexo'];
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
    <?php if($sexo == 'mujer'){ ?>
    <p><?php echo $palabras['index']['bienvenida_m'].' '.$nombre?></p>
    <?php } if($sexo == 'hombre'){ ?>
    <p><?php echo $palabras['index']['bienvenida_h'].' '.$nombre ?></p>
    <?php } if($sexo == 'otros'){ ?>
    <p><?php echo $palabras['index']['bienvenida_o'].' '.$nombre ?></p>
    <?php } ?>
    <br>
    <a href="overview.php?id=<?php echo $id; ?>"><?php echo $palabras['index']['perfil']?></a>
    <br>
    <br>
<?php
include './idiomas/lista_idiomas.php';
?>
</body>
</html>