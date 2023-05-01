<?php
   session_start();
    include '../idiomas/idiomas.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../assets/css/login.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
   <title><?php echo $palabras['config']['login_title'];?></title>
</head>
<body>
      <form action="" method="post" class="form_log">
         <?php
            session_start();

            include "bbdd.php";

            if(isset($_POST['submit'])){

               $email = $_POST['email'];
               $pass = md5($_POST['password']);

               $res = $conn->query("SELECT * FROM usuarios WHERE email = '$email'") or die($conn->$error);

               $usuario = mysqli_fetch_assoc($res);

               $campos = array();
               
               if(mysqli_num_rows($res) == 0){

                  array_push($campos, $palabras['login']['errores']['correo_no_regis']);

               }elseif($email == '' || strpos($email, '@') == false){

                  array_push($campos, $palabras['login']['errores']['correo_valido']);

               }elseif($pass == '' || $pass != $usuario['password']){

                  array_push($campos, $palabras['login']['errores']['pass_incorrecta']);

               }elseif($usuario['confirmado'] != 'si'){

                  array_push($campos, $palabras['login']['errores']['cuenta_no_verif']);

               }
               if(count($campos) > 0){

                  echo '<div class="error">';
                  for ($i=0; $i < count($campos); $i++) { 
                     echo '<li>'.$campos[$i].'</i>';
                  }

            }else{

                  $_SESSION['id'] = $id;
                  $_SESSION['SESSION_EMAIL'] = $email;

                  header("Location: home.php");
                  
            }
            echo '</div>';
         }

         ?>
         <h1><?php echo $palabras['login']['title'];?></h1>
         <br>
         <label><?php echo $palabras['login']['correo'];?></label>
         <input type="text" name="email" placeholder="<?php echo $palabras['login']['place_correo'];?>">
         <br>
         <br>
         <label><?php echo $palabras['login']['pass'];?></label>
         <input type="password" name="password" placeholder="<?php echo $palabras['login']['place_pass'];?>">
         <br>
         <br>
         <input type="submit" name="submit" value="<?php echo $palabras['login']['boton_log'];?>">
         <br>
         <br>
         <p><?php echo $palabras['login']['cuenta_no'];?> <a href="signup.php"><?php echo $palabras['login']['sign_up'];?></a></p>
         <br>
      </form>
      <?php
        include '../complementos/footer.php';
      ?>
</body>
</html>