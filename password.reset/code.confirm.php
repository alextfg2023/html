<?php
    session_start();
    include '../idiomas/idiomas.php'; 

    if(isset($_GET['email']) && isset($_GET['token'])){
        $email=$_GET['email'];
        $token=$_GET['token'];
    }else{
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['reset_title'] ?></title>
    <!-- CSS only -->
<link href="../assets/css/reset_pass.css" rel="stylesheet">
</head>
<body>
    <div class="contenedor">
        <div class="title"><?php echo $palabras['recuperar_pass']['correo_verif']['titulo'] ?></div>
        <form action="../complementosPHP/codigo_restablecer_pass_verif_token.php" method="POST">
            <div class="password-change">
                <div class="input-box">
                    <input type="text" name="codigo" placeholder="<?php echo $palabras['recuperar_pass']['correo_verif']['codigo'] ?>" autocomplete="off">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                </div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="<?php echo $palabras['recuperar_pass']['correo_verif']['boton'] ?>">
            </div>
        </form>
        <span class="idiomas">
                <?php include '../idiomas/lista_idiomas.php';?>
        </span> 
    </div>
</body>
</html>