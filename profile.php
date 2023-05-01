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
    $sexo = $row['sexo'];

}



if (isset($_POST['actualizar_foto'])) {
    $ruta = './profilepictures/'.md5($id).'/';
    $fichero = $ruta.basename($_FILES['imagen']['name']);
    $directorio = $ruta.md5(basename($_FILES['imagen']['name'])).'jpg';
    if(!file_exists($ruta)){
        mkdir($ruta);
    }
    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio)){

        require ('./bbdd.php');

        if ($imagen != '') {
            unlink($imagen);
        }

        $insert = $conn->query("UPDATE usuarios SET imagen = '$directorio' WHERE id = '$id'");
        header('Location:profile.php?id='.$id.'');
    }
}

if(isset($_POST['actualizar_datos'])){
    $nombre_n = $_POST['nombre_act'];
    $tipo_n = $_POST['tipo_act'];
    $sexo_n = $_POST['sexo'];

    $conn->query("UPDATE usuarios SET nombre = '$nombre_n', tipo = '$tipo_n', sexo = '$sexo_n' WHERE id = '$id'")or die($conn->$error);
    header('Location:.profile.php?id='.$id.'');

}
    if($_GET['id'] == $id){
        if ($_SESSION['lang'] == 'en') {
            echo $nombre.$palabras['perfil']['saludo'];
        } else {
            echo $palabras['perfil']['saludo']." ".$nombre;
        }
?>
    <p><?php echo $palabras['perfil']['foto_perfil'] ?><img src="<?php echo $imagen; ?>" width="100"></p>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="imagen">
        <?php if($imagen == '') {?>
        <input type="submit" value="<?php echo $palabras['perfil']['añadir_foto'] ?>" name="actualizar_foto">
        <?php }else{?>
        <input type="submit" value="<?php echo $palabras['perfil']['actualizar_foto'] ?>" name="actualizar_foto">
        <?php } ?>
        <br>
        <br>
        <label><?php echo $palabras['perfil']['nombre'] ?></label> <input type="text" name="nombre_act" value="<?php echo $nombre;?>" autocomplete="off">
        <br>
        <br>
        <label><?php echo $palabras['perfil']['tipo_user'] ?></label>
        <?php if($tipo == 'estudiante'){ ?>
        <select name="tipo_act">
            <option value="estudiante"><?php echo $palabras['perfil']['tipo_user_estudiante'] ?></option>
            <option value="trabajador"><?php echo $palabras['perfil']['tipo_user_trabajador'] ?></option>
            <option value="ambos"><?php echo $palabras['perfil']['tipo_user_ambos'] ?></option>
        </select>
        <?php } if ($tipo == 'trabajador'){?>
        <select name="tipo_act">
            <option value="trabajador"><?php echo $palabras['perfil']['tipo_user_trabajador'] ?></option>
            <option value="estudiante"><?php echo $palabras['perfil']['tipo_user_estudiante'] ?></option>
            <option value="ambos"><?php echo $palabras['perfil']['tipo_user_ambos'] ?></option>
        </select>
        <?php } if($tipo == 'ambos'){?>
        <select name="tipo_act">
            <option value="ambos"><?php echo $palabras['perfil']['tipo_user_ambos'] ?></option>
            <option value="trabajador"><?php echo $palabras['perfil']['tipo_user_trabajador'] ?></option>
            <option value="estudiante"><?php echo $palabras['perfil']['tipo_user_estudiante'] ?></option>
        </select>
        <?php }?>
        <br>
        <br>
        <label><?php echo $palabras['perfil']['sexo'] ?></label>
        <?php if($sexo == 'hombre'){ ?>
        <select name="sexo">
            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
        </select>
        <?php } if ($sexo == 'mujer'){?>
        <select name="sexo">
            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
        </select>
        <?php } if($sexo == 'otros'){?>
        <select name="sexo">
            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
        </select>
        <?php }?>
        <br>
        <br>
        <input type="submit" value="<?php echo $palabras['perfil']['actualizar_datos'] ?>" name="actualizar_datos">
    </form>
    <p><a href="./overview.php?id=<?php echo $id; ?>"><?php echo $palabras['perfil']['volver_overview'] ?></a></p>
    <p><a href="./logout.php"><?php echo $palabras['config']['cerrar_sesion'] ?></a></p>

    <?php
    include './idiomas/lista_idiomas.php';
    }     
    ?>
</body>
</html>