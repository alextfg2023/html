<?php

include '../complementosPHP/bbdd.php';
session_start();

if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: ../index.php");
    }

    include '../idiomas/idiomas.php'; 


$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $nombre = $row['nombre'];
    $id = $row['id'];
    $sexo = $row['sexo'];
    $username = $row['username'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['home_title']?></title>
</head>
<body>
    <br>
    <p>
        <?php 
            if($sexo == 'hombre'){
                echo $palabras['home']['bienvenido'].' '.$username;
            } elseif($sexo == 'mujer'){
                echo $palabras['home']['bienvenida'].' '.$username;
            } ?>
    </p>
    <br>
    <a href="overview.php?id=<?php echo $id; ?>"><?php echo $palabras['home']['perfil']?></a>
    <br>
    <br>
    <a href="../create.tables/create.table.php" class="">Crear tabla</a>
    <br>
    <br>
    <a href="../test_tablas/ver_tabla.php" class="">Ver mis tablas</a>
    <br>
    <br>
<?php
include '../idiomas/lista_idiomas.php';
?>
</body>
</html>