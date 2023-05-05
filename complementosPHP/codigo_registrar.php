<?php

    $sexo = '';
    $tipo = '';
            
    if(isset($_POST['submit'])){
                    
        $username = $_POST['username'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $cemail = $_POST['cemail'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $fecha_reg = date('Y-m-d H:i:s');
            
        $res_email = $conn->query("SELECT * FROM usuarios WHERE email = '$email' ") or die($conn->$error);
        $res_username = $conn->query("SELECT * FROM usuarios WHERE username = '$username' ") or die($conn->$error);
            
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
                        
            $pattern = '/[^\w]/';
            $campos = array();
            $correcto = array();
                    
            if(mysqli_num_rows($res_username) > 0){
                array_push($campos, $palabras['registro']['errores']['username_en_uso']);
            }
            if($username == ''){
                array_push($campos, $palabras['registro']['errores']['username_vacio_invalido']);
            }
            if(preg_match($pattern, $username)){
                array_push($campos, $palabras['registro']['errores']['username_invalido']);
            }
            if($nombre == ''){
                            array_push($campos, $palabras['registro']['errores']['nom_vacio']);
            }
            if($pass == '' || strlen($pass) < 8){
                            array_push($campos, $palabras['registro']['errores']['pass_vacia_corta']);
            }
            if($pass != $cpass){
                            array_push($campos, $palabras['registro']['errores']['pass_distintas']);
            }
            if(mysqli_num_rows($res_email) > 0){
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

                array_push($correcto, $palabras['registro']['correcto']['registro_correcto']);

                echo '<div class="correcto">';
                for ($i=0; $i < count($correcto); $i++) { 
                    echo '<li>'.$correcto[$i].'</i>';
                }

                include "../mail/mail_registro.php";
            
                if($enviado){
            
                $secure_pass = md5($pass);
            
                $conn->query("INSERT INTO usuarios (nombre, email, password, tipo, confirmado, codigo, imagen, fecha_registro, sexo, username) 
                VALUES ('$nombre', '$email', '$secure_pass', '$tipo', 'no', '$codigo', '', '$fecha_reg', '$sexo', '$username') ")or die($conn->$error);
            
                }else{
            
                    echo 'El correo de verificación no se pudo enviar';
                }
            }
                        
            echo '</div>';
    }
?>