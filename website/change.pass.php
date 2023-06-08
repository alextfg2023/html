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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/change.pass.css">
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
                            <a href="profile.php?id=<?php echo $id?>">
                                <span class="icon"><i class="fas fa-user-edit"></i></span>
                                <span class="title"><?php echo $palabras['general']['edit_perf']?></span>
                            </a>
                        </li>
                        <hr>
                        <li>
                        <a href="change.pass.php?id=<?php echo $id; ?>" class="active">
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
                if (isset($_POST['cambiar_pass'])) {

                    $pass_ant = md5($_POST['pass_antig']);
                    $pass_n = md5($_POST['pass_n']);
                    $pass_conf = md5($_POST['pass_n_conf']);
                    
                    if($pass_n == $pass_ant){
                ?>
                    <form action="" method="POST">
                    <div class="error-container">
                        <div class="error-message">

                            <h1><?php echo $palabras['contraseña']['error']['titulo'] ?></h1>
                            <br>
                            <p><?php echo $palabras['contraseña']['error']['mensaje2'] ?> </p>
                            <br>
                            <div class="error-button">
                                <input type="submit" name="submit" value="<?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['boton'] ?>">
                            </div>
                        </div>
                    </div>
                    </form>
                <?php
                    }elseif($pass_n != $pass_conf){
                ?>
                    <form action="" method="POST">
                    <div class="error-container">
                        <div class="error-message">
            
                            <h1><?php echo $palabras['contraseña']['error']['titulo'] ?></h1>
                            <br>
                            <p><?php echo $palabras['contraseña']['error']['mensaje1'] ?> </p>
                            <br>
                            <div class="error-button">
                                <input type="submit" name="submit" value="<?php echo $palabras['contraseña']['error']['boton'] ?>">
                            </div>
                        </div>
                    </div>
                    </form>
                <?php
                    }elseif($pass_ant != $pass) {
                ?>
                    <form action="" method="post">
                    <div class="error-container">
                        <div class="error-message">
            
                            <h1><?php echo $palabras['contraseña']['error']['titulo'] ?></h1>
                            <br>
                            <p><?php echo $palabras['contraseña']['error']['mensaje3'] ?> </p>
                            <br>
                            <div class="error-button">
                                <input type="submit" name="submit" value="<?php echo $palabras['contraseña']['error']['boton'] ?>">
                            </div>
                        </div>
                    </div>
                    </form>
                <?php
                    }else{
                        $conn->query("UPDATE usuarios SET password = '$pass_n' WHERE id = '$id'")or die($conn->error);
                ?>
                    <form action="" method="post">
                    <div class="correct-container">
                        <div class="correct-message">
                            <h1><?php echo $palabras['contraseña']['correcto']['titulo'] ?></h1>
                            <br>
                            <div class="correct-button">
                                <input type="submit" name="submit" value="<?php echo $palabras['contraseña']['correcto']['boton'] ?>">
                            </div>
                        </div>
                    </div>
                    </form>
                <?php
                    }
                }
                ?>
                    <div class="update-profile">
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php
                                $langKey = isset($palabras['lang']) ? $palabras['lang'] : '';
                                if ($_GET['id'] == $id) {
                                    echo "<h2>".$palabras['contraseña']['titulo']."</h2><br>";
                            ?>
                            <br>
                            <div class="flex">
                                <div class="inputBox">
                                    <span><?php echo $palabras['contraseña']['antigua']; ?></span>
                                    <input type="password" name="pass_antig" placeholder="<?php echo $palabras['contraseña']['place_antigua']; ?>" class="box">
                                    <br>
                                    <br>
                                    <span><?php echo $palabras['contraseña']['nueva']; ?></span>
                                    <input type="password" name="pass_n" placeholder="<?php echo $palabras['contraseña']['place_new']; ?>" class="box">
                                </div>
                                <div class="inputBox">
                                    <span><?php echo $palabras['contraseña']['nueva_conf']; ?></span>
                                    <input type="password" name="pass_n_conf" placeholder="<?php echo $palabras['contraseña']['place_conf']; ?>" class="box">
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="<?php echo $palabras['contraseña']['cambiar']; ?>" name="cambiar_pass" class="btn">
                        </form>
                    </div>
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