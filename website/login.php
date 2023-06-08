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
   <link rel="stylesheet" href="../assets/css/iniciosesion.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   <title><?php echo $palabras['config']['login_title'];?></title>
</head>
<body>
   <?php
   $errores = false;
   include '../complementosPHP/bbdd.php';
   require ('../complementosPHP/codigo_iniciar_sesion.php');
      if($errores){
   ?> 
   <div class="error-container">
        <div class="error-message">
            <h1><?php echo $palabras['login']['errores']['titulo_error'] ?></h1>
            <br>
            <p><?php for ($i=0; $i < count($campos); $i++) { echo '<li class="info">'.$campos[$i].'</li>'; } ?></p>
            <br>
            <form action="login.php">
               <div class="error-button">
                    <input type="submit" value="<?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['boton'] ?>">
               </div>
            </form>
        </div>
   </div>
   <?php }else{?>
   <div class="contenedor">
      <div class="title"><?php echo $palabras['login']['title'] ?></div>
      <br>
      <form action="" method="post" class="form_log">
         <div class="user-details">
            <div class="input-box">
               <input type="text" name="identificador" placeholder="<?php echo $palabras['login']['place_identificador'];?>" 
               value="<?php if (isset($_COOKIE['identificador']) && $_COOKIE['identificador'] != '') { echo $_COOKIE['identificador']; } else { echo isset($_POST['identificador']) ? $_POST['identificador'] : ''; } ?>" required>
               <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input-box">
            <input type="password" name="password" placeholder="<?php echo $palabras['login']['place_pass'];?>" 
            value="<?php if (isset($_COOKIE['password']) && $_COOKIE['password'] != '') { echo $_COOKIE['password']; } else { echo isset($_POST['password']) ? $_POST['password'] : ''; } ?>" required>
               <i class="uil uil-lock password"></i>
               <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <br>
            <div class="recordar">
              <span class="checkbox">
                <input type="checkbox" name="recordar" id="recordar" <?php if(isset($_COOKIE['usuario_login'])){?> checked <?php }?>/>
                <label for="recordar"><?php echo $palabras['login']['recordar'];?></label>
              </span>
              <a href="../password.reset/pass.reset.php" class="forgot_pw"><?php echo $palabras['login']['pass_olvidada'];?></a>
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
   <?php }?>
</body>
</html>