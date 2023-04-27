<?php

session_start();
include 'bbdd.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = "SELECT * FROM users WHERE email = '$email' 
   AND password = '$pass'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_assoc($result);

      $_SESSION['SESSION_EMAIL'] = $email;
      header('location: index.php');
   }else{
      $message[] = 'Correo o contraseña incorrectos!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TimerLab</title>

</head>
<body>
   <form action="" method="post">
      <h1>Inicia sesión</h1>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<b><p class="error">'.$message.'</p></b>';
         }
      }
      ?>
      <label>Correo electrónico</label>
      <input type="email" name="email" placeholder="Dirección de correo" required>
      <label>Contraseña</label>
      <input type="password" name="password" placeholder="Contraseña" required>
      <br>
      <input type="submit" name="submit" value="Iniciar sesion">
      <br>
      <center>
      <p>¿No tienes cuenta? <a href="registro.php">Registrate</a></p>
      </center>
      <br>
   </form>

</body>
</html>