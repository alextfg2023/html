<?php
    session_start();

    include '../idiomas/idiomas.php'; 

    include '../complementosPHP/bbdd.php';

    if($_POST['submit']){

        $email = $_POST['email'];

        $reg = $conn->query("SELECT * FROM usuarios WHERE email = '$email'") or die($conn->$error);

        $no_registrado = false;

        if(mysqli_num_rows($reg) == 0){

            $no_registrado = true;
            
        }else{
            
            if (mysqli_num_rows($reg) > 0) {
                $row = mysqli_fetch_assoc($reg);
                $id = $row['id'];
                }
                $token = $token = bin2hex(random_bytes(5));

            include '../mail/mail_reset_pass.php';

            if($enviado){

            $conn->query("INSERT INTO passwords (email, token, codigo, id_user) 
            VALUES ('$email', '$token', '$codigo', '$id')") or die($conn->error);

            }

        }
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
    <?php if($no_registrado){ ?> 
        <div class="error-container">
            <div class="error-message">
                <h1><?php echo $palabras['recuperar_pass']['conf_correo']['error']['titulo'] ?></h1>
                <br>
                <p><?php echo $palabras['recuperar_pass']['conf_correo']['error']['mensaje'] ?></p>
                <br>
                <p><?php echo $palabras['recuperar_pass']['conf_correo']['error']['registrar']?><b><a class="a" href="../website/signup.php"><?php echo $palabras['recuperar_pass']['conf_correo']['error']['enlace']?></b></a></p>
            </div>
        </div>
    <?php } elseif($enviado){ ?> 
        <div class="correct-container">
            <div class="correct-message">
                <h1><?php echo $palabras['recuperar_pass']['conf_correo']['correcto']['titulo'] ?></h1>
                <p><?php echo $palabras['recuperar_pass']['conf_correo']['correcto']['mensaje'] ?></p>
            </div>
        </div>
    <?php } else {?> 
    <div class="contenedor">
        <div class="title"><?php echo $palabras['recuperar_pass']['conf_correo']['titulo'] ?></div>
        <form action="" method="POST">
            <div class="password-change">
                <div class="input-box">
                    <input type="email" name="email" placeholder="<?php echo $palabras['recuperar_pass']['conf_correo']['place_correo'] ?>">
                </div>
                <div class="button">
                    <input type="submit" name ="submit" value="<?php echo $palabras['recuperar_pass']['conf_correo']['boton'] ?>">
                </div>
            </div>
        </form>
        <span class="idiomas">
            <?php include '../idiomas/lista_idiomas.php';?>
        </span> 
        <?php } ?>
    </div>
</body>
</html>