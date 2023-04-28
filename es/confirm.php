<?php

if(isset($_GET['email'])){
    $email = $_GET['email'];
    
}else{
    header('Location: ./login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifiación de cuenta - TimerLab</title>
</head>
<body>
    <form action="./verification.php" method="POST">
        <h2>Verificar Cuenta</h2>
            <label for="c" class="form-label">Código de Verificación</label>
            <input type="number" class="form-control" id="codigo" name="codigo">
            <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email;?>">
               
            <button type="submit" class="btn btn-primary">Verificar</button>
    </form>
</body>
</html>
