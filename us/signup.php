<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Sign Up - TimerLab</title>
</head>
<body>
        <form method="POST" action="PHP/registro.php" enctype="multipart/form-data" class="formulario">
        <h1>Sign Up</h1>
            <br>
            <label>What's your email?</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            <br>
            <br>
            <label>Confirmyour email</label>
            <input type="email" name="cemail" placeholder="Enter your email again" required>
            <br>
            <br>
            <label>¿What's your name?</label>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <br>
            <br>
            <label>Create a password</label>
            <input type="password" minlength="8" name="password" placeholder="Create a password" required>
            <br>
            <br>
            <label>Confirmayour password</label>
            <input type="password" minlength="8" name="cpassword" placeholder="Confirm your password">
            <br>
            <br>
                <input type="radio" name="tipo_usuario" value="estudiante">
                <label>Student</label>
                    
                <input type="radio" name="tipo_usuario" value="trabajador">
                <label>Worker</label>
                    
                <input type="radio" name="tipo_usuario" value="ambos">
                <label>Both</label>
            <br>
            <br>
            <input type="submit" name="submit" value="Sign Up">

            <br>
                <p class="n">Have an account? <a href="login.php">Log in</a></p>
            <br>
        </form>
   <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<b><p>'.$error.'</p></b>';
            };
        };
    ?>
</body>
</html>