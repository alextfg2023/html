<?php
    session_start();
    include '../complementosPHP/bbdd.php';
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: ../index.php");
    }

    include '../idiomas/idiomas.php';

    if(isset($_POST['borrar_def'])){
        $id_usuario = $_POST['id_usuario'];
        $id_tabla = $_POST['id_tabla_borrar'];
        $nombre_tabla = $_POST['nombre_tabla_borrar'];
        $nombre_tabla_confirm = strtoupper($nombre_tabla);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/borrar_sche.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST['confirmado'])){
        $id_tabla_confirmada = $_POST['id_confirm'];
        $id_usuario_confirmado = $_POST['user_confirm'];
        $nombre_tabla_confirmada = $_POST['name_confirm'];

        $querytablas = mysqli_query($conn, "SELECT * FROM tablas WHERE id_usuario = '$id_usuario_confirmado'");

        while ($rowTabla = mysqli_fetch_assoc($querytablas)) {
            $nombre_tabla = strtoupper($rowTabla['nombre']);
        }

        if($nombre_tabla_confirmada == $nombre_tabla ){

            $borrado = mysqli_query($conn, "DELETE FROM tablas WHERE id = '$id_tabla_confirmada'");

            if($borrado){
                ?>
                    <div class="correct-container">
                        <div class="correct-message">
                            <h1><?php echo $palabras['view_tablas']['borrar_tabla']['borrado_completo_titulo'] ?></h1>
                            <p><?php echo $palabras['view_tablas']['borrar_tabla']['borrado_completo1'] ?><b><?php echo $nombre_tabla ?></b><?php echo $palabras['view_tablas']['borrar_tabla']['borrado_completo2']; ?></p>
                            <form method="post" action="../create.sche/view.sche.php">
                                <div class="correct-button">
                                    <input type="submit" value="<?php echo $palabras['view_tablas']['borrar_tabla']['volver']; ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
            }
        }
    } else{
    ?>
    <div class="error-container">
        <div class="error-message">
            <h1><?php echo $palabras['view_tablas']['borrar_tabla']['mensaje_aviso']; ?></h1>
            <p><?php echo $palabras['view_tablas']['borrar_tabla']['mensaje_confirmacion']; echo $nombre_tabla_confirm; ?></p>
            <form method="post" action="">
                <input class="input-box" type="text" name="name_confirm" required>
                <input type="hidden" name="id_confirm" value="<?php echo $id_tabla; ?>">
                <input type="hidden" name="user_confirm" value="<?php echo $id_usuario; ?>">
                <div class="error-button">
                    <br>
                    <input type="submit" class="subir" name="confirmado" value="<?php echo $palabras['view_tablas']['borrar_tabla']['borrar_definitivo']; ?>">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    }
?>