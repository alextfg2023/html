<?php
   session_start();

   include "./bbdd.php";

   $email = $_POST['email'];
   $pass = md5($_POST['password']);

   $res = $conn->query("SELECT * FROM usuarios WHERE email = '$email'") or die($conn->$error);
   
   if(mysqli_num_rows($res) == 0){

      echo "The email is not registered";

   } else{

      $usuario = mysqli_fetch_assoc($res);

      if($usuario['confirmado'] != 'si'){

         echo "The account is not verified. Please check the email and verify it before logging in";

      } elseif($pass != $usuario['password']){

         echo "The password is incorrect. Please try again";

      } else{

         $_SESSION['id'] = $id;
         $_SESSION['SESSION_EMAIL'] = $email;

         header("Location: ../index.php");

      }

   }
?>
<!DOCTYPE html>
<head>
    <title>Log In - TimerLab</title>
</head>
<body>
</body>
</html>