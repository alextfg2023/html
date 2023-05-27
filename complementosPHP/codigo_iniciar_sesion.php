<?php
if (isset($_POST['submit'])) {
    $identificador = $_POST['identificador'];
    $pass = md5($_POST['password']);

    $res = $conn->query("SELECT * FROM usuarios WHERE email = '$identificador' OR username = '$identificador'") or die($conn->$error);

    $usuario = mysqli_fetch_assoc($res);

    $campos = array();
    $errores = false;

    if (mysqli_num_rows($res) == 0) {
        array_push($campos, $palabras['login']['errores']['usuario_no_regis']);
    } elseif ($identificador == '') {
        array_push($campos, $palabras['login']['errores']['correo_valido']);
    } elseif ($pass == '' || $pass != $usuario['password']) {
        array_push($campos, $palabras['login']['errores']['pass_incorrecta']);
    } elseif ($usuario['confirmado'] != 'si') {
        array_push($campos, $palabras['login']['errores']['cuenta_no_verif']);
    }

    if (count($campos) > 0) {
        $errores = true;
    } else {
        if (isset($_POST['recordar'])) {
            setcookie("identificador", urlencode($_POST['identificador']), time() + (86400 * 30), "/"); // Cookie válida por 30 días
            setcookie("password", urlencode($_POST['password']), time() + (86400 * 30), "/"); // Cookie válida por 30 días
        }

        $_SESSION['id'] = $id;
        $_SESSION['SESSION_EMAIL'] = $identificador;

        header("Location: ../website_test/home.php");
        exit(); // Importante agregar esta línea para detener la ejecución del código después de redirigir
    }

    echo '</div>';
}
?>
