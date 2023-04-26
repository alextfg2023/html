<?php

include 'bbdd.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $cemail = mysqli_real_escape_string($conn, $_POST['cemail']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM users WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'El correo ya está en uso!';

   }else{

      if($pass != $cpass){
         $error[] = 'Las contraseñas no coinciden!';
      }elseif($email != $cemail){
         $error[] = 'Los correos no coinciden!';
      }else{
         $insert = "INSERT INTO users (email, nombre, password) 
         VALUES('$email','$name','$pass')";
         mysqli_query($conn, $insert);
         header('location:registrocompleto.php');
      }
   }

};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resgistro</title>
    <link rel="stylesheet" href="assets/css/stylesregistro.css">    
</head>
<body>
   <form method="POST" action="" enctype="multipart/form-data">
   <h1>Registrate</h1>
      <br>
      <label>¿Cual es tu correo electrónico?</label>
      <input type="email" name="email" placeholder="Dirección de correo" required>
      <label>Confirma tu correo electrónico</label>
      <input type="email" name="cemail" placeholder="Confirme su dirección de correo" required>
      <label>¿Cómo te llamamos?</label>
      <input type="text" name="name" placeholder="Nombre" required>
      <label>Crea una contraseña</label>
      <input type="password" minlength="8" name="password" placeholder="Contraseña" required>
      <label>Confirma tu contraseña</label>
      <input type="password" minlength="8" name="cpassword" placeholder="Confirme su contraseña">
      <br>
      <input type="submit" name="submit" value="Registrarse">
      <br>
      <center>
         <p class="n">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
      </center>
      <br>
   </form>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<b><p class="error">'.$error.'</p></b>';
         };
      };
   ?>
</body>
</html>