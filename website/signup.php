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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title><?php echo $palabras['config']['signup_title'];?></title>
</head>
<body>
    <div class="form_reg">
        <form method="POST" action="" enctype="multipart/form-data">
            <?php

            include 'bbdd.php';

            $sexo = '';
            $tipo = '';

            if(isset($_POST['submit'])){


                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $cemail = $_POST['cemail'];
                $pass = $_POST['password'];
                $cpass = $_POST['cpassword'];
                $fecha_reg = date('Y-m-d H:i:s');

                
                $res = $conn->query("SELECT * FROM usuarios WHERE email = '$email' ") or die($conn->$error);

                if(isset($_POST['tipo_usuario'])){
                    $tipo = $_POST['tipo_usuario'];
                }else{
                    $tipo = '';
                }
                if(isset($_POST['sexo'])){
                    $sexo = $_POST['sexo'];
                }else{
                    $sexo = '';
                }

                $campos = array();

                if($nombre == ''){

                    array_push($campos, $palabras['registro']['errores']['nom_vacio']);

                }
                if($pass == '' || strlen($pass) < 8){

                    array_push($campos, $palabras['registro']['errores']['pass_vacia_corta']);

                }
                if($pass != $cpass){

                    array_push($campos, $palabras['registro']['errores']['pass_distintas']);

                }
                if(mysqli_num_rows($res) > 0){

                    array_push($campos, $palabras['registro']['errores']['correo_en_uso']);

                }
                if($email == '' || strpos($email, '@') == false){

                    array_push($campos, $palabras['registro']['errores']['correo_invalido']);

                }
                if($email != $cemail){

                    array_push($campos, $palabras['registro']['errores']['correos_distintos']);

                }
                if($tipo == ''){

                    array_push($campos, $palabras['registro']['errores']['elegir_tipo']);

                }
                if($sexo == ''){

                    array_push($campos, $palabras['registro']['errores']['elegir_sexo']);

                }
                if(count($campos) > 0){

                    echo '<div class="error">';
                    for ($i=0; $i < count($campos); $i++) { 
                        echo '<li>'.$campos[$i].'</i>';
                    }

                }else{

                    echo '<div class="correcto">'.$palabras['registro']['correcto']['registro_correcto'].'</div>';
                    include "../mail/mail.php";

                    if($enviado){

                        $secure_pass = md5($pass);

                        $conn->query("INSERT INTO usuarios (nombre, email, password, tipo, confirmado, codigo, imagen, fecha_registro, sexo) 
                        VALUES ('$nombre', '$email', '$secure_pass', '$tipo', 'no', '$codigo', '', '$fecha_reg', '$sexo') ")or die($conn->$error);

                    }else{

                        echo 'El correo de verificación no se pudo enviar';
                    }
                }
            
                echo '</div>';
            }
            ?>

            <h1><?php echo $palabras['registro']['title'] ?></h1>
            <br>
            <label><?php echo $palabras['registro']['crear_correo'] ?></label>
            <input type="text" name="email" placeholder="<?php echo $palabras['registro']['place_crear_correo'] ?>">
            <br>
            <br>
            <label><?php echo $palabras['registro']['conf_correo'] ?></label>
            <input type="text" name="cemail" placeholder="<?php echo $palabras['registro']['place_conf_correo'] ?>">
            <br>
            <br>
            <label><?php echo $palabras['registro']['crear_nombre'] ?></label>
            <input type="text" name="nombre" placeholder="<?php echo $palabras['registro']['place_crear_nombre'] ?>">
            <br>
            <br>
            <label><?php echo $palabras['registro']['crear_pass'] ?></label>
            <input type="password" name="password" placeholder="<?php echo $palabras['registro']['place_crear_pass'] ?>">
            <br>
            <br>
            <label><?php echo $palabras['registro']['conf_pass'] ?></label>
            <input type="password" name="cpassword" placeholder="<?php echo $palabras['registro']['place_conf_pass'] ?>">
            <br>
            <br>
            <div>
                <p>
                    <?php echo $palabras['registro']['tipo']?>
                    <input type="radio" name="tipo_usuario" value="estudiante" id="estudiante" class = "inputs">
                    <label for="estudiante"><?php echo $palabras['registro']['tipo_estudiante'] ?></label>
                            
                    <input type="radio" name="tipo_usuario" value="trabajador" id="trabajador">
                    <label for="trabajador"><?php echo $palabras['registro']['tipo_trabajador'] ?></label>
                            
                    <input type="radio" name="tipo_usuario" value="ambos" id="ambos">
                    <label for="ambos"><?php echo $palabras['registro']['tipo_ambos'] ?></label>
                </p>
            </div>
            <br>
            <div>
                <p>
                    <?php echo $palabras['registro']['sexo'] ?>
                    <input type="radio" name="sexo" value="hombre" id="hombre" class = "inputs">
                    <label for="hombre"><?php echo $palabras['registro']['sexo_m'] ?></label>
                                
                    <input type="radio" name="sexo" value="mujer" id="mujer">
                    <label for="mujer"><?php echo $palabras['registro']['sexo_f'] ?></label>

                    <input type="radio" name="sexo" value="otros" id="otros">
                    <label for="otros"><?php echo $palabras['registro']['sexo_o'] ?></label>
                </p>
            </div>
            <br>
            <input type="submit" name="submit" value="<?php echo $palabras['registro']['boton_reg'] ?>">
            <br>
            <br>
                <p><?php echo $palabras['registro']['cuenta_si'] ?> <a href="login.php"><?php echo $palabras['registro']['log_in']?></a></p>
            <br>  
        </form>
    </div>
    <?php
        include '../complementos/footer.php';
    ?>
</body>
</html>