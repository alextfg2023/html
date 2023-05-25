<?php
include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

if(isset($_POST['crear'])){

    $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
            
        $row = mysqli_fetch_assoc($query);
        $nombre = $row['nombre'];
        $id = $row['id'];
        $sexo = $row['sexo'];
        $username = $row['username'];
        $imagen = $row['imagen'];

    }

    $nombre_tabla = $_POST['nombre_tabla'];

    $insert = mysqli_query($conn, "INSERT INTO tablas (nombre, id_usuario) VALUES ('$nombre_tabla', '$id')")or die($conn->error);

    if($insert){
        echo "Tabla ".$nombre_tabla." agregada correctamente";
    }

}
?>