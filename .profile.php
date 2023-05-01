<?php
    
    session_start();

    if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: index.php");
    }

    include './idiomas/idiomas.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['perfil_title'];?></title>


</head>
<body>
<?php
if(isset($_GET['id'])){
    include "./bbdd.php";

    $query = $conn->query("SELECT * FROM usuarios WHERE id = '{$_GET['id']}'");

    $row = mysqli_fetch_assoc($query);

    $nombre = $row['nombre'];
    $id = $row['id'];
    $imagen = $row['imagen'];
    $tipo = $row['tipo'];
    $pass = $row['password'];
    $email = $row['email'];

    if($nombre == $nombre){
        
        echo '<script>alert("'.$palabras['perfil']['alerta'].'"); window.location.href = "profile.php?id='.$id.'"</script>';

    }

}