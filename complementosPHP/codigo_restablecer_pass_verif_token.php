<?php

    session_start();

    include '../idiomas/idiomas.php'; 
    include 'bbdd.php';

    $email = $_POST['email'];
    $token = $_POST['token'];
    $codigo = $_POST['codigo'];

    $res=$conn->query("SELECT * FROM passwords WHERE
    email = '$email' AND token = '$token' AND codigo = '$codigo'")or die($conn->error);

    $correcto = false;
    
    if(mysqli_num_rows($res) > 0){

        $fila = mysqli_fetch_row($res);
        $fecha = $fila[4];
        $fecha_actual = date("Y-md h:m:s");
        $secons = strtotime($fecha_actual) - strtotime($fecha);
        $minutos = $seconds / 60;

        if($minutos > 8){

            echo 'token vencido';

        }else{

            $correcto = true;

        }

    }else{
        $correcto = false;
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
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<?php if($correcto){ ?>
    <div class="contenedor">
    <div class="title"><?php echo $palabras['recuperar_pass']['cambiar_pass']['titulo'] ?></div>
        <form action="cambiar_contraseña.php" method="POST">
            <div class="password-change">
                <div class="input-box-new">
                    <input type="password"name="password" placeholder="<?php echo $palabras['recuperar_pass']['cambiar_pass']['new_pass'] ?>" minlength="8" required>
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                </div>
                <div class="input-box-new">
                    <input type="password"name="cpassword" placeholder="<?php echo $palabras['recuperar_pass']['cambiar_pass']['cnew_pass'] ?>" minlength="8" required>
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                    <input type="hidden" name="email" value="<?php echo $email ?>">
                    <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
                </div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="<?php echo $palabras['recuperar_pass']['cambiar_pass']['boton'] ?>"/>
            </div>
        </form>
        <?php }else{ ?>
            <div class="error-container">
                <div class="error-message">
                    <h1><?php echo $palabras['recuperar_pass']['correo_verif']['error']['titulo'] ?></h1>
                    <br>
                    <p><?php echo $palabras['recuperar_pass']['correo_verif']['error']['mensaje1'] ?></p>
                    <br>
                    <p><?php echo $palabras['recuperar_pass']['correo_verif']['error']['mensaje2'] ?><a class="a" href="../password.reset/pass_reset.php"><b><?php echo $palabras['recuperar_pass']['correo_verif']['error']['enlace'] ?></b></a></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="../complementosJS/show_pass.js"></script> 
</body>
</html>