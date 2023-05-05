<?php

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
        if($minutos > 10){

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
    <title>Cambiar contraseña</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:15%">
        <?php if($correcto){ ?>
            <form class="col-3" action="cambiar_contraseña.php" method="POST">
                <h2>Restablecer Password</h2>
                <div class="mb-3">
                    <label for="c" class="form-label">Nueva contraseña</label>
                    <input type="password" class="form-control" id="c" name="password">
                 
                </div>
                <div class="mb-3">
                    <label for="c" class="form-label">Confirmar nueva contraseña</label>
                    <input type="password" class="form-control" id="c" name="cpassword">
                    <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email ?>">
                </div>
                <button type="submit" class="btn btn-primary">Restablecer</button>
            </form>
            <?php }else{ ?>

                <div class="alert alert-danger"> Código incorrecto o vencido</div>
                
            <?php } ?>
        </div>
    </div>
</body>
</html>