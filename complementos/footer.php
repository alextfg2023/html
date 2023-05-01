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
    <title>Document</title>
</head>
<body>
    <footer class="pie">
        <div class="header">
            <div class="leng">
                <form method="POST" action="" enctype="multipart/form-data" class="formulario">
                    <label for="lang"><?php echo $palabras['config']['idioma'] ?></label>
                    <select name="lang" id="lang" onchange="this.form.submit()">
                        <option value="es" <?php echo ($idioma == 'es') ? 'selected' : ''; ?>><?php echo $palabras['idiomas']['idioma1'] ?></option>
                        <option value="en" <?php echo ($idioma == 'en') ? 'selected' : ''; ?>><?php echo $palabras['idiomas']['idioma2'] ?></option>
                    </select>
                </form>
            </div>
            <div class="logo">
                <p>TimerLab</p>
            </div>
    </footer>
</body>
</html>