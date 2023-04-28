<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log In - TimerLab</title>

</head>
<body>
   <form action="./PHP/login.php" method="post">
      <h1>Log In</h1>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<b><p class="error">'.$message.'</p></b>';
         }
      }
      ?>
      <label>Email</label>
      <input type="email" name="email" placeholder="Email" required>
      <br>
      <br>
      <label>Password</label>
      <input type="password" name="password" placeholder="Passwod" required>
      <br>
      <br>
      <input type="submit" name="submit" value="Log In">
      <br>
      <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
      <br>
   </form>

</body>
</html>