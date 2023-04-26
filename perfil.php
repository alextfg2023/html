<?php
    include 'bbdd.php';
    session_start();

    if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: index.php");
    }
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $id = $row['id'];
        $email = $row['email'];
        $nombre = $row['nombre'];
        $contraseña = $row['password'];
        $imagen = $row['imagen'];
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
    <p><?php echo 'Hola '.$nombre;?></p>
    <p>Foto de perfil:<img src="<?php echo $imagen; ?>" width="100"></p>
    <form method="POST" action?="" enctype="multipart/form-data">
        <input type="file" name="imagen">
        <input type="submit" value="Actualizar foto de perfil" name="subir">
    </form>
    <p><a href="logout.php">Cerrar sesión</a></p>
    <a href="tabladesglose.php">Ver mis horarios</a>
<?php
    if (isset($_POST['subir'])) {
        $ruta = 'fotoperfil/'.$id.'/';
        $fichero = $ruta.basename($_FILES['imagen']['name']);
        $directorio = $ruta.$id.".jpg";
        if(!file_exists($ruta)){
            mkdir($ruta);
        }
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio)){
            
            require ('bbdd.php');

            $insert = $conn->query("UPDATE users SET imagen = '$directorio' WHERE id = '$id'");
            header('Location:perfil.php?id='.$id.'');
        }
    }
?>
</body>
</html>