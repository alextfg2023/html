<?php
session_start();

if(isset($_GET['email'])){
    $email = $_GET['email'];
    
}else{
    header('Location: ./login.php');
}

include './idiomas/idiomas.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['confirm_title'] ?></title>
</head>
<body>
    <form action="./verification.php" method="POST">
        <h2><?php echo $palabras['confirmacion']['verify_acc'] ?></h2>
            <label for="c" class="form-label"><?php echo $palabras['confirmacion']['cod_verify'] ?></label>
            <input type="number" class="form-control" id="codigo" name="codigo" placeholder="<?php echo $palabras['confirmacion']['cod_verify_ej'] ?>">
            <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email;?>">
               
            <button type="submit" class="btn btn-primary"><?php echo $palabras['confirmacion']['boton_verify'] ?></button>
    </form>
    <br>
    <?php
        include './idiomas/lista_idiomas.php';
    ?>
</body>
</html>
