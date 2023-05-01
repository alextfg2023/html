<?php
    include '../idiomas/idiomas2.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/footer.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    </head>
    <body class="body_foot">
        <footer class="pie">
            <div class="header">
                <!--Idioma-->
                <div class="leng">
                    <form method="POST" action="" enctype="multipart/form-data" class="formulario">
                        <label for="lang" class="texto"><?php echo $palabras['config']['idioma'].' '?></label>
                        <select name="lang" id="lang" onchange="this.form.submit()" class="texto">
                            <option value="es" <?php echo ($idioma == 'es') ? 'selected' : ''; ?> class="options"><?php echo $palabras['idiomas']['idioma1'] ?></option>
                            <option value="en" <?php echo ($idioma == 'en') ? 'selected' : ''; ?> class="options"><?php echo $palabras['idiomas']['idioma2'] ?></option>
                        </select>
                    </form>
                </div>
                <!--Logo-->
                <div class="logo">
                    <p class="texto">TimerLab</p>
                </div>
            </div>
        </footer>
</body>
</html>