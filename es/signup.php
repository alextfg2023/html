<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>TimerLab - Registro</title>
    <style>
        body{
            background-color: #264673;
            box-sizing: border-box;
            font-family: Arial;
        }

        form{
            background-color: white;
            padding: 10px;
            margin: 90px auto;
            width:410px;
        }

        input[type=text], input[type=password]{
            padding: 10px;
            width: 380px;
        }

        input[type="submit"]{
            border: 0;
            background-color: #ED8824;
            padding: 10px 20px;
        }

        .error{
            background-color: #FF9185;
            font-size: 13px;
            padding: 10px;
            padding-left: 15px;
        }

        .correcto{
            background-color: #A0DEA7;
            font-size: 13px;
            padding: 10px;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data" class="formulario">
    <?php

    include './bbdd.php';

    if(isset($_POST['submit'])){

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $cemail = $_POST['cemail'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $tipo = $_POST['tipo_usuario'];
        $fecha_reg = date('Y-m-d H:i:s');
        $sexo = $_POST['sexo'];

        
        $res = $conn->query("SELECT * FROM usuarios WHERE email = '$email' ") or die($conn->$error);

        $campos = array();

        if($nombre == ''){

            array_push($campos, 'El nombre no puede estar vacio!');

        }
        if($pass == '' || strlen($pass) < 8){

            array_push($campos, 'La contraseña no puede estar vacia ni tener menos de 8 caracteres!');

        }
        if($pass != $cpass){

            array_push($campos, 'Las contraseñas no coinciden!');

        }
        if(mysqli_num_rows($res) > 0){

            array_push($campos, 'El correo ya está en uso!');

        }
        if($email == '' || strpos($email, '@') == false){

            array_push($campos, 'Introduce un correo valido!');

        }
        if($email != $cemail){

            array_push($campos, 'Los correos introducidos no coinciden!');

        }
        if(count($campos) > 0){

            echo '<div class="error">';
            for ($i=0; $i < count($campos); $i++) { 
                echo '<li>'.$campos[$i].'</i>';
            }

        }else{

            echo '<div class="correcto">
            Te has registrado correctamente! Por favor revisa tu bandeja de correo y verifica tu cuenta antes de iniciar sesión</div>';
            include "./mail/mail.php";

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

    <h1>Registrate</h1>
        <label>¿Cual es tu correo electrónico?</label>
        <input type="text" name="email" placeholder="Dirección de correo">
        <br>
        <br>
        <label>Confirma tu correo electrónico</label>
        <input type="text" name="cemail" placeholder="Confirme su dirección de correo">
        <br>
        <br>
        <label>¿Cómo te llamamos?</label>
        <input type="text" name="nombre" placeholder="Nombre">
        <br>
        <br>
        <label>Crea una contraseña</label>
        <input type="password" minlength="8" name="password" placeholder="Contraseña">
        <br>
        <br>
        <label>Confirma tu contraseña</label>
        <input type="password" minlength="8" name="cpassword" placeholder="Confirme su contraseña">

        <div>
            <p>¿A que te dedicas?</p>
            <input type="radio" name="tipo_usuario" value="estudiante" id="estudiante">
            <label for="estudiante">Estudiante</label>
                    
            <input type="radio" name="tipo_usuario" value="trabajador" id="trabajador">
            <label for="trabajador">Trabajador</label>
                    
            <input type="radio" name="tipo_usuario" value="ambos" id="ambos">
            <label for="ambos">Ambos</label>
        </div>
        <div>
            <p>Introduce tu sexo:</p>
            <input type="radio" name="sexo" value="hombre" id="hombre">
            <label for="hombre">Hombre</label>
                        
            <input type="radio" name="sexo" value="mujer" id="mujer">
            <label for="mujer">Mujer</label>

            <input type="radio" name="sexo" value="otros" id="otros">
            <label for="otros">Otros</label>
        </div>
        <br>
        <input type="submit" name="submit" value="Registrarse">

        <br>
            <p class="n">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
        <br>
    </form>
</body>
</html>