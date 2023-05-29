<?php
    session_start();
    include '../idiomas/idiomas.php'; 
    include 'bbdd.php';

    $token = $_POST['token'];
    $codigo = $_POST['codigo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $pass_ant = $conn->query("SELECT * FROM usuarios WHERE email = '$email'")or die($conn->error);

    $row = mysqli_fetch_assoc($pass_ant);
    $antigua_pass = $row['password'];
    $new_secure_pass = md5($password);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/reset_pass.css" rel="stylesheet">
    <title><?php echo $palabras['config']['reset_title'] ?></title>
</head>
<body>
    <?php
        if($new_secure_pass == $antigua_pass){
    ?>
        <form action="codigo_restablecer_pass_verif_token.php" method="POST">
        <div class="error-container">
            <div class="error-message">

                <h1><?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['titulo'] ?></h1>
                <br>
                <p><?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['mensaje2'] ?> </p>
                <br>
                <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <div class="error-button">
                    <input type="submit" name="submit" value="<?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['boton'] ?>">
                </div>
            </div>
        </div>
        </form>
        <?php } elseif($password == $cpassword){
            
            $conn->query("UPDATE usuarios SET password = '$new_secure_pass' WHERE email = '$email'")or die($conn->error);

        ?>
        <div class="correct-container">
            <div class="correct-message">
                <h1><?php echo $palabras['recuperar_pass']['cambiar_pass']['correcto']['titulo'] ?></h1>
                <br>
                <p><?php echo $palabras['recuperar_pass']['cambiar_pass']['correcto']['mensaje1'] ?><a class="a" href="../website/login.php"><b><?php echo $palabras['recuperar_pass']['cambiar_pass']['correcto']['enlace'] ?></b></a></p>
            </div>
        </div>
    <?php } else{ ?>
        <form action="codigo_restablecer_pass_verif_token.php" method="POST">
        <div class="error-container">
            <div class="error-message">

                <h1><?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['titulo'] ?></h1>
                <br>
                <p><?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['mensaje1'] ?></p>
                <br>
                <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <div class="error-button">
                    <input type="submit" name="submit" value="<?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['boton'] ?>">
                </div>
            </div>
        </div>
        </form>
    <?php } ?>
</body>
</html>
