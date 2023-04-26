<?php

session_start();
include 'bbdd.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$_SESSION['SESSION_EMAIL']}'");



if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $id = $row['id'];
    }

if(isset($_POST['submit'])){

    $nombre_t = mysqli_real_escape_string($conn, $_POST['n_tabla']);
    $valor1 = mysqli_real_escape_string($conn, $_POST['valor1']);
    $valor2 = mysqli_real_escape_string($conn, $_POST['valor2']);
    $valor3 = mysqli_real_escape_string($conn, $_POST['valor3']);
    $valor4 = mysqli_real_escape_string($conn, $_POST['valor4']);
    $valor5 = mysqli_real_escape_string($conn, $_POST['valor5']);
    $valor6 = mysqli_real_escape_string($conn, $_POST['valor6']);

    $query2 = "SELECT * FROM valores WHERE id_user = $id AND nombre_tabla = '$nombre_t'";
    $result = mysqli_query($conn, $query2);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'Ya existe una tabla con ese nombre!';
    }else{
    $insert = "INSERT INTO valores (id_user, nombre_tabla, valor_1, valor_2, valor_3, valor_4, valor_5, valor_6) 
        VALUES('{$row['id']}','$nombre_t','$valor1','$valor2','$valor3','$valor4','$valor5','$valor6')";
    
    mysqli_query($conn, $insert);
    header('location:datossubidos.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styleshome.css">
</head>
<body>
<form action="" method="POST">
        <h1>Crear Horario</h1>
        <br>
        <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<p class="error">'.$error.'</p>';
                };
            };
            ?>
        <br>
            <label>¿Como llamamos a tu horario?</label>
            <input type="text" name="n_tabla" placeholder="Introduce un nombre">
            <label>Tarea 1</label>
            <input type="text" name="valor1" placeholder="Introduce una tarea">
            <label>Tarea 2</label>
            <input type="text" name="valor2" placeholder="Introduce una tarea">
            <label>Tarea 3</label>
            <input type="text" name="valor3" placeholder="Introduce una tarea">
            <label>Tarea 4</label>
            <input type="text" name="valor4" placeholder="Introduce una tarea">
            <label>Tarea 5</label>
            <input type="text" name="valor5" placeholder="Introduce una tarea">
            <label>Tarea 6</label>
            <input type="text" name="valor6" placeholder="Introduce una tarea">
            <br>
            <input type="submit" name="submit" value="Enviar datos">
            <br>
            <center>
            <p><a href="tabladesglose.php">Ver mis horarios</a> o <a href="logout.php">Cerrar sesión</a></p>
            </center>
            <br>
        </form>

</body>
</html>