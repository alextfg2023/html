<?php

    include 'bbdd.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['password'];

    if($password==$cpassword){

        $new_secure_pass = md5($password);
        $conn->query("UPDATE usuarios SET password = '$new_secure_pass' WHERE email = '$email'")or die($conn->error);
        echo 'Correcto!';

    }else{

        echo 'No coinciden';
        
    }
    
?>