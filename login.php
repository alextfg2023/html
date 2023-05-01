<?php
   session_start();
    include './idiomas/idiomas.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $palabras['config']['login_title'];?></title>
   <style>
        body{
            background-color: #264673;
            box-sizing: border-box;
            font-family: 'Bruno-Ace';
        }

        form{
            background-color: white;
            padding: 10px;
            margin: 90px auto;
            width:410px;
        }

        input[type=text], input[type=password]{
            padding: 10px;
            width: 380px;
        }

        input[type="submit"]{
            border: 0;
            background-color: #ED8824;
            padding: 10px 20px;
            cursor: pointer;
        }

        .error{
            background-color: #FF9185;
            font-size: 13px;
            padding: 10px;
            padding-left: 15px;
        }

        .correcto{
            background-color: #A0DEA7;
            font-size: 13px;
            padding: 10px;
            padding-left: 15px;
        }
    </style>
</head>
<body>
      <form action="" method="post">
         <?php
            session_start();

            include "./bbdd.php";

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

                  header("Location: ./index.php");
                  
            }
            echo '</div>';
         }

         ?>
         <h1><?php echo $palabras['login']['title'];?></h1>
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
         <p><?php echo $palabras['login']['cuenta_no'];?> <a href="signup.php"><?php echo $palabras['login']['sign_up'];?></a></p>
         <br>
      </form>
      <?php
         include './idiomas/lista_idiomas.php';
      ?>
</body>
</html>