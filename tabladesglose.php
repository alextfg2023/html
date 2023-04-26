<?php

session_start();
include 'bbdd.php';
    $query2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query2) > 0) {
        $row = mysqli_fetch_assoc($query2);
        $id = $row['id'];
        $email = $row['email'];
        $nombre = $row['nombre'];
        $contraseña = $row['password'];
        $imagen = $row['imagen'];
    }
    $query = "SELECT * FROM valores WHERE id_user = (
            SELECT id FROM users where email = '{$_SESSION['SESSION_EMAIL']}')";
    $resultado = mysqli_query($conn, $query);
    if(mysqli_num_rows($resultado) == 0){
        $vacio[] = '!VAYA¡, parece que todavia no tienes ningun horario, crea uno ahora <a href="creaciontablas.php">aquí</a>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/stylestablas.css">
    <script type="text/javascript" src="js/seleccionHorario.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <?php
        if(isset($vacio)){
            foreach ($vacio as $vacio) {
                echo '<p>'.$vacio.'</p>';
            }
        }else{
    ?>
    Selecciona tu horario:
    <select id="horario" onchange="opcionHorario()">
        <?php
            while ($rows = mysqli_fetch_array($resultado)) {
        ?>  
            <option value="<?php echo $rows['nombre_tabla']; ?>"><?php echo $rows['nombre_tabla']; ?></option>
        <?php
            }
        ?>
    </select>
    <br>
    <br>
    <table>
        <thead>
            <th>1</th>
            <th>2</th>
            <th>3</th>
        </thead>
        <tbody id="res">

        </tbody>
    </table>
    <?php 
        }
    ?>
    <p><a href="perfil.php?id= <?php echo $id; ?>">Ir a mi perfil</a></p>
    <p><a href="creaciontablas.php">Crear un horario</a></p>
</body>
</html>
