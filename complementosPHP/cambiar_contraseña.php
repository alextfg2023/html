<?php
    session_start();
    include '../idiomas/idiomas.php'; 
    include 'bbdd.php';

    $token = $_POST['token'];
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/reset_pass.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
        if($password == $cpassword){

            $new_secure_pass = md5($password);
            $conn->query("UPDATE usuarios SET password = '$new_secure_pass' WHERE email = '$email'")or die($conn->error);
    ?>
        <div class="correct-container">
            <div class="correct-message">
                <h1>Contraseña cambiada correctamente!</h1>
                <br>
                <p>Ahora puedes <a class="a" href="../website/login.php">iniciar sesión!</a></p>
            </div>
        </div>
    <?php } else{ ?>
        <form action="codigo_restablecer_pass_verif_token.php" method="POST">
        <div class="error-container">
            <div class="error-message">
                <h1>Error</h1>
                <br>
                <p>Las contraseñas no coinciden!</p>
                <br>
                <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <div class="error-button">
                    <input type="submit" name="submit" value="Reintentar">
                </div>
            </div>
        </div>
        </form>
    <?php } ?>
</body>
</html>
