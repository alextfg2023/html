<?php
    
    session_start();
    if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: home.php");
    }

    include '../idiomas/idiomas.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['overview_title'];?></title>
</head>
<body>
<?php
if(isset($_GET['id'])){
    include 'bbdd.php';

    $query = $conn->query("SELECT * FROM usuarios WHERE id = '{$_GET['id']}'");

    $row = mysqli_fetch_assoc($query);

    $nombre = $row['nombre'];
    $id = $row['id'];
    $tipo = $row['tipo'];
    $email = $row['email'];
    $fecha_reg = $row['fecha_registro'];

    

}
    if($_GET['id'] == $id){
?>
    <p><?php echo $palabras['general']['saludo']." ".$nombre;?></p>
    <p><?php echo $palabras['general']['correo']." ".$email; ?></p>
    <p><?php echo $palabras['general']['fecha_reg']." ".$fecha_reg; ?></p>
    <?php if($tipo == 'ambos'){
        $tipo_ambos = $palabras['general']['tipo_ambos'];
    ?>
    <p><?php echo $palabras['general']['tipo_cuenta']." ".$tipo_ambos; ?></p>
    <?php
    }if($tipo == 'trabajador'){
        $tipo_trabajador = $palabras['general']['tipo_trabajador'];
    ?>
    <p><?php echo $palabras['general']['tipo_cuenta']." ".$tipo_trabajador; ?></p>
    <?php
    }if($tipo == 'estudiante'){
        $tipo_estudiante = $palabras['general']['tipo_estudiante'];
    ?>
    <p><?php echo $palabras['general']['tipo_cuenta']." ".$tipo_estudiante; ?></p>
    <?php
    }
    ?>
    <p><a href="profile.php?id=<?php echo $id;?>"><?php echo $palabras['general']['edit_perf']?></a></p>
    <p><a href="logout.php"><?php echo $palabras['config']['cerrar_sesion']?></a></p>
    <?php
        include '../idiomas/lista_idiomas.php';
    }     
    ?>

</body>
</html>