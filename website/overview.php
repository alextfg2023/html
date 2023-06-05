<?php
    
    session_start();
    if(!isset($_SESSION['SESSION_EMAIL'])){
        header("Location: home.php");
    }

    include '../idiomas/idiomas.php'; 

    if(isset($_GET['id'])){
        include '../complementosPHP/bbdd.php';
    
        $query = $conn->query("SELECT * FROM usuarios WHERE id = '{$_GET['id']}'");
    
        $row = mysqli_fetch_assoc($query);
    
        $nombre = $row['nombre'];
        $id = $row['id'];
        $tipo = $row['tipo'];
        $email = $row['email'];
        $fecha_reg = $row['fecha_registro'];
        $username = $row['username'];
        $sexo = $row['sexo'];
        $imagen = $row['imagen'];
    }
    if($_GET['id'] == $id){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/overviewstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome5.12.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title><?php echo $palabras['config']['overview_title'];?></title>
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
                            <a href="overview.php?id=<?php echo $id?>" class="active">
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
                    <img src="<?php echo $imagen; ?>" class="img_ov">
                </div>
                <div class="item">
                    <?php echo "<p>".$palabras['general']['name']."</p> <p>".$nombre."</p>"; ?>
                </div>
                <div class="item">
                    <?php echo "<p>".$palabras['general']['sexo']."</p> <p>".$sexo."</p>"; ?>
                </div>
                <div class="item">
                    <?php echo "<p>".$palabras['general']['correo']."</p> <p>".$email."</p>"; ?>
                </div>
                <div class="item">
                    <?php echo "<p>".$palabras['general']['fecha_reg']."</p> <p>".$fecha_reg."</p>"; ?>
                </div>
                <div class="item">
                    <?php if($tipo == 'ambos'){
                        $tipo_ambos = $palabras['general']['tipo_ambos'];
                    ?>
                        <?php echo "<p>".$palabras['general']['tipo_cuenta']."</p> <p>".$tipo_ambos."</p>"; ?>
                    <?php
                        }if($tipo == 'trabajador'){
                            $tipo_trabajador = $palabras['general']['tipo_trabajador'];
                    ?>
                        <?php echo "<p>".$palabras['general']['tipo_cuenta']."</p> <p>".$tipo_trabajador."</p>"; ?>
                    <?php
                        }if($tipo == 'estudiante'){
                            $tipo_estudiante = $palabras['general']['tipo_estudiante'];
                    ?>
                        <?php echo "<p>".$palabras['general']['tipo_cuenta']."</p> <p>".$tipo_estudiante."</p>"; ?>
                    <?php
                        }
                    ?>
                </div>
                <form action="profile.php?id=<?php echo $id?>" method="post">
                    <div class="button">
                        <input type="submit" value="<?php echo $palabras['general']['edit_perf']?>"/>
                    </div>
                </form>
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
    <?php
        }     
    ?>
</body>
</html>