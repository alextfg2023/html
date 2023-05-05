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
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   <title><?php echo $palabras['config']['login_title'];?></title>
</head>
<body>
   <div class="contenedor">
      <div class="title"><?php echo $palabras['login']['title'] ?></div>
      <br>
      <form action="" method="post" class="form_log">
         <?php
            include '../complementosPHP/bbdd.php';
            include '../complementosPHP/codigo_iniciar_sesion.php';
         ?>
         <div class="user-details">
            <div class="input-box">
               <input type="text" name="identificador" placeholder="<?php echo $palabras['login']['place_identificador'];?>" required>
               <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input-box">
               <input type="password" name="password" placeholder="<?php echo $palabras['login']['place_pass'];?>" required>
               <i class="uil uil-lock password"></i>
               <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <br>
            <div class="recordar">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="../password.reset/pass_reset.php" class="forgot_pw">Forgot password?</a>
            </div>
         </div>
         <div class="button">
            <input type="submit" name="submit" value="<?php echo $palabras['login']['boton_log'];?>">
         </div>
         <div class="enlace">
            <span>
               <?php echo $palabras['login']['cuenta_no'];?> <a href="signup.php"><?php echo $palabras['login']['sign_up'];?></a>
            </span>
            <br>
            <br>
         </div>
      </form>
      <span class="idiomas">
         <?php include '../idiomas/lista_idiomas.php';?>
      </span> 
   </div>
   <script src="../complementosJS/show_pass.js"></script> 
</body>
</html>