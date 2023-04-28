<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TimerLab - Login</title>
   <style>
        body{
            background-color: #264673;
            box-sizing: border-box;
            font-family: Arial;
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

               array_push($campos, 'El correo no está registrado');

            }
            if($email == '' || strpos($email, '@') == false){

               array_push($campos, 'Introduce un correo valido!');

            } 
            if($pass == '' || $pass != $usuario['password']){

               array_push($campos, 'Contraseña incorrecta, intentalo de nuevo');

            }
            if($usuario['confirmado'] != 'si'){

               array_push($campos, 'La cuenta no está verificada. Por favor revisa el correo y verificala antes de iniciar sesión');

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
      <h1>Inicia sesión</h1>
      <label>Correo electrónico</label>
      <input type="text" name="email" placeholder="Dirección de correo">
      <br>
      <br>
      <label>Contraseña</label>
      <input type="password" name="password" placeholder="Contraseña">
      <br>
      <br>
      <input type="submit" name="submit" value="Iniciar sesion">
      <br>
      <p>¿No tienes cuenta? <a href="signup.php">Registrate</a></p>
      <br>
   </form>

</body>
</html>