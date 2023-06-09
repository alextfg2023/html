<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
}

include '../idiomas/idiomas.php';

if (isset($_GET['id'])) {

    include "../complementosPHP/bbdd.php";

    $id = $_GET['id'];
    $query = $conn->query("SELECT * FROM usuarios WHERE id = '$id'");

    if (mysqli_num_rows($query) > 0) {

        $row = mysqli_fetch_assoc($query);

        $nombre = $row['nombre'];
        $id = $row['id'];
        $imagen = $row['imagen'];
        $tipo = $row['tipo'];
        $pass = $row['password'];
        $email = $row['email'];
        $sexo = $row['sexo'];
        $username = $row['username'];

        if (isset($_POST['actualizar_datos'])) {
            $email_n = $_POST['email_act'];
            $nombre_n = $_POST['nombre_act'];
            $tipo_n = $_POST['tipo_act'];
            $sexo_n = $_POST['sexo_act'];
            $username_n = $_POST['username_act'];
            $imagen_n = $_POST['imagen'];
            $ruta = '../profilepictures/' . md5($id) . '/';
            $fichero = $ruta . basename($_FILES['imagen']['name']);
            $directorio = $ruta . md5(basename($_FILES['imagen']['name'])) . '.jpg';

            if (!file_exists($ruta)) {
                mkdir($ruta);
            }

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio)) {
                require('../complementosPHP/bbdd.php');

                if ($imagen == '../profilepictures/default/default-avatar.png') {
                }elseif ($imagen == $directorio){
                }else{
                    unlink($imagen);
                    $conn->query("UPDATE usuarios SET imagen = '$directorio' WHERE id = '$id'");
                }
            }
            
            $actdatos = $conn->query("UPDATE usuarios SET username = '$username_n', nombre = '$nombre_n', tipo = '$tipo_n', sexo = '$sexo_n' WHERE id = '$id'") or die($conn->$error);
            
            header('Location: profile.php?id='.$id);

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome5.12.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title><?php echo $palabras['config']['perfil_title']; ?></title>
</head>
<body>
<div class="wrapper">
        <div class="top_navbar">
            <div class="hamburger">
                <div class="hamburger_inner">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
            </div>
            <div class="menu">
                <div class="logo">
                    <h2><?php echo $palabras['config']['index_title'] ?></h2>
                </div>
                <div class="right_menu">
                    <ul>
                        <li>
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>" alt="profile.pic" class="fas">
                            <div class="profile_dd">
                                <div class="dd_item">
                                    <a href="home.php"><?php echo $palabras['general']['volver']?></a>
                                </div>
                                <div class="dd_item">
                                    <a href="../complementosPHP/logout.php"><?php echo $palabras['config']['cerrar_sesion']?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main_container">
            <div class="sidebar">
                <div class="sidebar_inner">
                    <div class="profile">
                        <div class="img">
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>" alt="profile_pic">
                        </div>
                        <div class="profile_info">
                            <p class="profile_name"><?php echo $username;?></p>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <a href="overview.php?id=<?php echo $id?>">
                                <span class="icon"><i class="fas fa-id-card"></i></span>
                                <span class="title"><?php echo $palabras['general']['general']?></span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="profile.php?id=<?php echo $id?>" class="active">
                                <span class="icon"><i class="fas fa-user-edit"></i></span>
                                <span class="title"><?php echo $palabras['general']['edit_perf']?></span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="change.pass.php?id=<?php echo $id; ?>">
                                <span class="icon"><i class="fas fa-key"></i></span>
                                <span class="title"><?php echo $palabras['general']['cambiar_pass']?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="idiomas">
                    <?php
                        include '../idiomas/lista_idiomas.php';
                    ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="item">
                    <div class="update-profile">
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php
                                $langKey = isset($palabras['lang']) ? $palabras['lang'] : '';
                                if ($_GET['id'] == $id) {
                                    if ($_SESSION['lang'] == 'en') {
                                        echo "<h2>".$palabras['perfil']['edicion'] . $nombre . $palabras['perfil']['edicion2']."</h2><br>";
                                    } else {
                                        echo "<h2>".$palabras['perfil']['edicion'] . " " . $nombre."</h2><br>";
                                    }
                            ?>
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>"><br>
                            <label for="file-input">
                                <i class="fas fa-upload"> 
                                </i>
                                <?php 
                                    if ($imagen == '../profilepictures/default/default-avatar.png') {
                                        echo "<p class='text'>".$palabras['perfil']['añadir_foto']."</p>";
                                    } else {
                                        echo "<p class='text'>".$palabras['perfil']['actualizar_foto']."</p>";
                                    } 
                                ?>
                            </label>
                            <input id="file-input" name="imagen" type="file" class="img">
                            <br>
                            <div class="flex">
                                <div class="inputBox">
                                    <span><?php echo $palabras['perfil']['nombre']; ?></span>
                                    <input type="text" name="nombre_act" value="<?php echo $nombre; ?>" class="box">
                                    <span><?php echo $palabras['perfil']['email']; ?></span>
                                    <input type="email" name="email_act" value="<?php echo $email; ?>" class="box">
                                    <span><?php echo $palabras['perfil']['sexo']; ?></span>
                                    <?php if($sexo == 'hombre'){ ?>
                                        <select name="sexo_act" class="box">
                                            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
                                            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
                                            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
                                        </select>
                                    <?php } if ($sexo == 'mujer'){?>
                                        <select name="sexo_act" class="box">
                                            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
                                            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
                                            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
                                        </select>
                                    <?php } if($sexo == 'otros'){?>
                                        <select name="sexo_act" class="box">
                                            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
                                            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
                                            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
                                        </select>
                                    <?php }?>
                                </div>
                                <div class="inputBox">
                                    <span><?php echo $palabras['perfil']['username']; ?></span>
                                    <input type="text" name="username_act" value="<?php echo $username; ?>" class="box">
                                    <span><?php echo $palabras['perfil']['tipo_user'] ?></span>
                                    <?php if ($tipo == 'estudiante') { ?>
                                        <select name="tipo_act" class="box">
                                            <option value="estudiante"><?php echo $palabras['perfil']['tipo_user_estudiante'] ?></option>
                                            <option value="trabajador"><?php echo $palabras['perfil']['tipo_user_trabajador'] ?></option>
                                            <option value="ambos"><?php echo $palabras['perfil']['tipo_user_ambos'] ?></option>
                                        </select>
                                    <?php } if ($tipo == 'trabajador'){?>
                                        <select name="tipo_act"  class="box">
                                            <option value="trabajador"><?php echo $palabras['perfil']['tipo_user_trabajador'] ?></option>
                                            <option value="estudiante"><?php echo $palabras['perfil']['tipo_user_estudiante'] ?></option>
                                            <option value="ambos"><?php echo $palabras['perfil']['tipo_user_ambos'] ?></option>
                                        </select>
                                    <?php } if($tipo == 'ambos'){?>
                                        <select name="tipo_act" class="box">
                                            <option value="ambos"><?php echo $palabras['perfil']['tipo_user_ambos'] ?></option>
                                            <option value="trabajador"><?php echo $palabras['perfil']['tipo_user_trabajador'] ?></option>
                                            <option value="estudiante"><?php echo $palabras['perfil']['tipo_user_estudiante'] ?></option>
                                        </select>
                                    <?php }?>
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="<?php echo $palabras['perfil']['actualizar_datos']; ?>" name="actualizar_datos" class="btn">
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../complementosJS/nav_bar.js"></script>
</body>
</html>