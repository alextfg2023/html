<?php

if(isset($_GET['email'])){
    $email = $_GET['email'];
    
}else{
    header('Location: ./login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification - TimerLab</title>
</head>
<body>
    <form action="./PHP/verification.php" method="POST">
        <h2>Verify account</h2>
            <label for="c" class="form-label">Verification code</label>
            <input type="number" class="form-control" id="codigo" name="codigo">
            <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email;?>">
               
            <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</body>
</html>
