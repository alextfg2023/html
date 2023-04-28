<?php
    
    session_start();

    if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - TimerLab</title>
</head>
<body>
<?php
if(isset($_GET['id'])){
    include "./PHP/bbdd.php";

    $query = $conn->query("SELECT * FROM usuarios WHERE id = '{$_GET['id']}'");

    $row = mysqli_fetch_assoc($query);

    $nombre = $row['nombre'];
    $id = $row['id'];
    $imagen = $row['imagen'];
    $tipo = $row['tipo'];
    $pass = $row['password'];
    $email = $row['email'];

}
?>
    <p><?php echo 'Hi '.$nombre;?></p>
    <p>Profile picture:<img src="<?php echo $imagen; ?>" width="100"></p>

<?php 
    if($_GET['id'] == $id){
?>

    <form method="POST" action?="" enctype="multipart/form-data">
        <input type="file" name="imagen">
        <?php if($imagen == '') {?>
        <input type="submit" value="Add an image" name="subir">
        <?php }else{?>
        <input type="submit" value="Update image" name="subir">
        <?php } ?>
    </form>
    <p><a href="./logout.php">Log out</a></p>

<?php 
    }     
?>
<?php
    if (isset($_POST['subir'])) {
        $ruta = 'fotoperfil/'.md5($id).'/';
        $fichero = $ruta.basename($_FILES['imagen']['name']);
        $directorio = $ruta.md5(basename($_FILES['imagen']['name'])).'jpg';
        if(!file_exists($ruta)){
            mkdir($ruta);
        }
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio)){

            require ('./PHP/bbdd.php');

            if ($imagen != '') {
                unlink($imagen);
            }

            $insert = $conn->query("UPDATE usuarios SET imagen = '$directorio' WHERE id = '$id'");
            header('Location:profiles.php?id='.$id.'');
        }
    }
?>

</body>
</html>