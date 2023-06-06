<?php
session_start();

if(isset($_GET['email'])){
    $email = $_GET['email'];
    
}else{
    header('Location: ../website/login.php');
}

include '../idiomas/idiomas.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../assets/css/confirmar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['confirm_title'] ?></title>
</head>
<body>
<?php
    include '../complementosPHP/bbdd.php';

    $res = $conn->query("SELECT * FROM usuarios WHERE email = '$email'") or die($conn->$error);
        
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        $nombre = $row['nombre'];
        $id = $row['id'];
        $sexo = $row['sexo'];
        $username = $row['username'];
        $imagen = $row['imagen'];
        $tipo = $row['tipo'];
        $codigo = $row['codigo'];
    }

    if(isset($_POST['verif'])){

        $email = $_POST['email'];
        $codigoin = $_POST['codigo'];

        if($codigoin == $codigo){
            $conn->query("UPDATE usuarios SET confirmado = 'si' WHERE email = '$email'");
?>
        <form action="../website/login.php" method="get">
        <div class="correct-container">
            <div class="correct-message">
                <h1><?php echo $palabras['verificacion']['verify_ok']; ?></h1>
                <br>
                <p><?php echo $palabras['verificacion']['mensaje']; ?> </p>
                <br>
                <div class="correct-button">
                    <input type="submit" name="submit" value="<?php echo $palabras['verificacion']['log_in']; ?>">
                </div>
            </div>
        </div>
        </form>
        <?php 
        } if($codigoin != $codigo) {
        ?>
        <form action="" method="POST">
        <div class="error-container">
            <div class="error-message">
                <h1><?php echo $palabras['verificacion']['no_verify']; ?></h1>
                <br>
                <p><?php echo $palabras['verificacion']['verify_error']; ?> </p>
                <br>
                <div class="error-button">
                    <input type="submit" name="submit" value="<?php echo $palabras['verificacion']['reintentar']; ?>">
                </div>
            </div>
        </div>
        </form>
        <?php 
        }
    } else {     
        ?>
    <div class="contenedor">
    <h2><?php echo $palabras['confirmacion']['verify_acc'] ?></h2>
        <form action="" method="POST">
            <div class="confirm">
                <div class="input-box-new">
                    <label for="c" class="form-label"><?php echo $palabras['confirmacion']['cod_verify'] ?></label>
                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="<?php echo $palabras['confirmacion']['cod_verify_ej'] ?>">
                    <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email;?>"> 
                </div>
            </div>
            <div class="button">
                <input type="submit" name="verif" value="<?php echo $palabras['confirmacion']['boton_verify'] ?>"/>
            </div>
            <?php
                include '../idiomas/lista_idiomas.php';
            ?>
        </form>
    </div>
    <?php
    }
    ?>
</body>
</html>
