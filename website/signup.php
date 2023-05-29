<?php
    session_start();
    include '../idiomas/idiomas.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../assets/css/registro.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <title><?php echo $palabras['config']['signup_title'];?></title>
</head>
<body>
    <?php
    $reg_completo = false;
    $errores = false;
        include '../complementosPHP/bbdd.php';
        include '../complementosPHP/codigo_registrar.php';
        if($reg_completo){
    ?> 
    <div class="correct-container">
        <div class="correct-message">
            <h1><?php echo $palabras['registro']['correcto']['titulo'] ?></h1>
            <br>
            <p><?php echo $palabras['registro']['correcto']['registro_correcto'] ?><b><a href="login.php" class="a"><?php echo $palabras['registro']['correcto']['enlace'] ?></a></b></p>
        </div>
    </div>
    <?php } elseif($errores){ ?> 
    <div class="error-container">
        <div class="error-message">
            <h1><?php echo $palabras['registro']['errores']['titulo_error'] ?></h1>
            <br>
            <p><?php for ($i=0; $i < count($campos); $i++) { echo '<li class="info">'.$campos[$i].'</li>'; } ?></p>
            <br>
            <form action="signup.php">
               <div class="error-button">
                    <input type="submit" value="<?php echo $palabras['registro']['errores']['reintentar_registro'] ?>">
               </div>
            </form>
            <p class="a"><b><a class="a" href="signup.php"><?php  ?></a></b></p>
        </div>
    </div>
    <?php }else { ?>
    <div class="contenedor">
        <div class="title"><?php echo $palabras['registro']['title'] ?></div>
        <br>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="user-details">
                <div class="input-box">
                    <input type="text" name="nombre" placeholder="<?php echo $palabras['registro']['crear_nombre'] ?>">
                    <i class="far fa-user user"></i>
                </div>
                <div class="input-box">
                    <input type="text" name="username" placeholder="<?php echo $palabras['registro']['crear_user'] ?>">
                    <i class="far fa-user user"></i>
                </div>
                <div class="input-box">
                    <input type="text" name="email" placeholder="<?php echo $palabras['registro']['crear_correo'] ?>">
                    <i class="uil uil-envelope-alt email"></i>
                </div>
                <div class="input-box">
                    <input type="text" name="cemail" placeholder="<?php echo $palabras['registro']['conf_correo'] ?>">
                    <i class="uil uil-envelope-alt email"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="<?php echo $palabras['registro']['crear_pass'] ?>">
                    <i class="uil uil-lock password"></i>
               <i class="uil uil-eye-slash pw_hide"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="cpassword" placeholder="<?php echo $palabras['registro']['conf_pass'] ?>">
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                </div>
            </div>
            <div class="tipo-details">
                <input type="radio" name="tipo_usuario" value="estudiante" id="dot-1">
                <input type="radio" name="tipo_usuario" value="trabajador" id="dot-2">
                <input type="radio" name="tipo_usuario" value="ambos" id="dot-3">
                <span class="tipo-title"><?php echo $palabras['registro']['tipo']?></span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="tipo"><?php echo $palabras['registro']['tipo_estudiante']?></span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="tipo"><?php echo $palabras['registro']['tipo_trabajador']?></span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="tipo"><?php echo $palabras['registro']['tipo_ambos']?></span>
                    </label>
                </div>
            </div>
            <div class="sexo-details">
                <input type="radio" name="sexo" value="hombre" id="dot-4">
                <input type="radio" name="sexo" value="mujer" id="dot-5">
                <input type="radio" name="sexo" value="otros" id="dot-6">
                <span class="sexo-title"><?php echo $palabras['registro']['sexo'] ?></span>
                <div class="category">
                    <label for="dot-4">
                        <span class="dot four"></span>
                        <span class="sexo"><?php echo $palabras['registro']['sexo_m']?></span>
                    </label>
                    <label for="dot-5">
                        <span class="dot five"></span>
                        <span class="sexo"><?php echo $palabras['registro']['sexo_f'] ?></span>
                    </label>
                    <label for="dot-6">
                        <span class="dot six"></span>
                        <span class="sexo"><?php echo $palabras['registro']['sexo_o'] ?></span>
                    </label>
                </div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="<?php echo $palabras['registro']['boton_reg'] ?>">
            </div>
            <div>
                <span class="enlace">
                    <?php echo $palabras['registro']['cuenta_si'] ?> <a href="login.php"><?php echo $palabras['registro']['log_in']?></a>
                </span>
                <br>
                <br>
            </div>
        </form>
        <span class="idiomas">
            <?php include '../idiomas/lista_idiomas.php';?>
        </span> 
    </div>
    <script src="../complementosJS/show_pass.js"></script>
    <?php } ?>
</body>
</html>
