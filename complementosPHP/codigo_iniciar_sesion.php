<?php
if(isset($_POST['submit'])){
    $identificador = $_POST['identificador'];
    $pass = md5($_POST['password']);

    $res = $conn->query("SELECT * FROM usuarios WHERE email = '$identificador' OR username = '$identificador'") or die($conn->$error);

    $usuario = mysqli_fetch_assoc($res);

    $campos = array();

    if(mysqli_num_rows($res) == 0){

    array_push($campos, $palabras['login']['errores']['usuario_no_regis']);

    }elseif($identificador == ''){

    array_push($campos, $palabras['login']['errores']['correo_valido']);

    }elseif($pass == '' || $pass != $usuario['password']){

    array_push($campos, $palabras['login']['errores']['pass_incorrecta']);

    }elseif($usuario['confirmado'] != 'si'){

    array_push($campos, $palabras['login']['errores']['cuenta_no_verif']);

    }
    if(count($campos) > 0){

    echo '<div class="error">';
    for ($i=0; $i < count($campos); $i++) { 
        echo '<li>'.$campos[$i].'</i>';
    }

    }else{

    $_SESSION['id'] = $id;
    $_SESSION['SESSION_EMAIL'] = $identificador;

    header("Location: home.php");
    
    }
echo '</div>';
}
?>