<?php
    if(isset($_GET['email']) && isset($_GET['token'])){
        $email=$_GET['email'];
        $token=$_GET['token'];
    }else{
        header('Location: ../index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:15%">
            <form class="col-3" action="../complementosPHP/codigo_restablecer_pass_verif_token.php" method="POST">
                <h2>Restablecer Password</h2>
                <div class="mb-3">
                    <label for="c" class="form-label">Codigo</label>
                    <input type="text" class="form-control" id="c" name="codigo">
                    <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" class="form-control" id="c" name="token" value="<?php echo $token; ?>">
                 
                </div>
               
                <button type="submit" class="btn btn-primary">Restablecer</button>
            </form>
        </div>
    </div>
</body>
</html>