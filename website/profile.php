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

        if (isset($_POST['actualizar_foto'])) {
            $ruta = '../profilepictures/' . md5($id) . '/';
            $fichero = $ruta . basename($_FILES['imagen']['name']);
            $directorio = $ruta . md5(basename($_FILES['imagen']['name'])) . '.jpg';

            if (!file_exists($ruta)) {
                mkdir($ruta);
            }

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio)) {
                require('../complementosPHP/bbdd.php');

                if ($imagen != '') {
                    unlink($imagen);
                }

                $conn->query("UPDATE usuarios SET imagen = '$directorio' WHERE id = '$id'");
                header('Location:profile.php?id=' . $id);
            }
        }

        if (isset($_POST['actualizar_datos'])) {
            $nombre_n = $_POST['nombre_act'];
            $tipo_n = $_POST['tipo_act'];
            $sexo_n = $_POST['sexo_act'];
            $username_n = $_POST['username_act'];
            
            $actdatos = $conn->query("UPDATE usuarios SET username = '$username_n', nombre = '$nombre_n', tipo = '$tipo_n', sexo = '$sexo_n' WHERE id = '$id'") or die($conn->$error);
            
            header('Location: .profile.php?id=' . $id);

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
    <link rel="stylesheet" href="../assets/css/profile.css">
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
                            <a href="#">
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
                    <?php
                        $langKey = isset($palabras['lang']) ? $palabras['lang'] : '';
                        if ($_GET['id'] == $id) {
                            if ($_SESSION['lang'] == 'en') {
                                echo $nombre . $palabras['perfil']['saludo'];
                            } else {
                                echo $palabras['perfil']['saludo'] . " " . $nombre;
                            }
                        ?>
                        <p><?php echo isset($palabras['perfil']['foto_perfil']) ? $palabras['perfil']['foto_perfil'] : ''; ?><img src="<?php echo isset($imagen) ? $imagen : ''; ?>" width="100"></p>
                    <form method="POST" action="" enctype="multipart/form-data">
                            <input type="file" name="imagen">
                            <?php if ($imagen == '') { ?>
                                <input type="submit" value="<?php echo isset($palabras['perfil']['añadir_foto']) ? $palabras['perfil']['añadir_foto'] : ''; ?>" name="actualizar_foto">
                            <?php } else { ?>
                                <input type="submit" value="<?php echo isset($palabras['perfil']['actualizar_foto']) ? $palabras['perfil']['actualizar_foto'] : ''; ?>" name="actualizar_foto">
                            <?php } ?>
                            <br><br>
                            <label><?php echo $palabras['perfil']['nombre'] ?></label>
                            <input type="text" name="nombre_act" value="<?php echo $nombre; ?>" autocomplete="off">
                            <br><br>
                            <label><?php echo $palabras['perfil']['username'] ?></label>
                            <input type="text" name="username_act" value="<?php echo $username; ?>" autocomplete="off">
                            <br><br>
                            <label><?php echo $palabras['perfil']['tipo_user'] ?></label>
                            <?php if ($tipo == 'estudiante') { ?>
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
                        <select name="sexo_act">
                            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
                            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
                            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
                        </select>
                        <?php } if ($sexo == 'mujer'){?>
                        <select name="sexo_act">
                            <option value="mujer"><?php echo $palabras['perfil']['sexo_m'] ?></option>
                            <option value="hombre"><?php echo $palabras['perfil']['sexo_h'] ?></option>
                            <option value="otros"><?php echo $palabras['perfil']['sexo_o'] ?></option>
                        </select>
                        <?php } if($sexo == 'otros'){?>
                        <select name="sexo_act">
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
                    <p><a href="../complementosPHP/logout.php"><?php echo $palabras['config']['cerrar_sesion'] ?></a></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Verifica si la pantalla es lo suficientemente grande para ejecutar el script
            if (window.matchMedia("(min-width: 584px)").matches) {
                // Código a ejecutar solo en pantallas grandes
                $(".hamburger").click(function(){
                    $(".wrapper").toggleClass("active");
                });
            }
            $(".right_menu li .fas").click(function(){
                    $(".profile_dd").toggleClass("active");
                });
        });
    </script>
</body>
</html>