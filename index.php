<?php
    session_start();
    include './idiomas/idiomas_index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <title><?php echo $palabras['config']['index_title']?></title>
</head>
<body>
    <header class="header">

        <div class="menu contenedor">

            <a href = "index.php" class="logo"><?php echo $palabras['index']['logo']?></a>
            <input type="checkbox" id ="menu" />

            <label for="menu">

                <img class="menu-icono" src="assets/img/index/menu.png" alt="">

            </label>
            <nav class="navbar">

                <ul>
                    <li><a href="./index.php"><?php echo $palabras['index']['nav_bar_1']?></a></li>
                    <li><a href="#funcionamiento"><?php echo $palabras['index']['nav_bar_2']?></a></li>
                </ul>

            </nav>
        </div>

        <div class="header-content contenedor">

            <h1><?php echo $palabras['index']['logo_inicial']?></h1>
            <p>
                <?php echo $palabras['index']['texto_inicio_p1']?>
            </p>
            <p>
                <?php echo $palabras['index']['texto_inicio_p2']?>
            </p>
            <p>
                <?php echo $palabras['index']['texto_inicio_p3']?>
            </p>
            <p>
            <a href="./website/signup.php" class="btn-1"><?php echo $palabras['index']['boton_reg']?></a>
                <?php echo $palabras['index']['boton_o']?>
            <a href="./website/login.php" class="btn-1"><?php echo $palabras['index']['boton_log']?></a>
            </p>

        </div>

    </header>

    <section class="funcionamiento" id="funcionamiento">

        <img class="funcionamiento-img" src="assets/img/index/seccion1.png" alt="">

        <div class="funcionamiento-content contenedor">

            <h2><?php echo $palabras['index']['funcionamiento']?></h2>
            <p class="txt-p">
                <?php echo $palabras['index']['explicacion_funcionamiento']?>
            </p>
            <div class="funcionamiento-group">

                <div class="funcionamiento-1">
                    <img src="assets/img/index/paso_1.png" alt="" class="img-1">
                    <h3><?php echo $palabras['index']['paso_1']?></h3>
                    <p>
                        <?php echo $palabras['index']['paso_1_descrip']?>
                    </p>
                </div>
                <div class="funcionamiento-1">
                    <img src="assets/img/index/paso_2.png" alt="" class="img-2">
                    <h3><?php echo $palabras['index']['paso_2']?></h3>
                    <p>
                        <?php echo $palabras['index']['paso_2_descrip']?>
                    </p>
                </div>
                <div class="funcionamiento-1">
                    <img src="assets/img/index/paso_3.png" alt="" class="img-3">
                    <h3><?php echo $palabras['index']['paso_3']?></h3>
                    <p>
                        <?php echo $palabras['index']['paso_3_descrip']?>
                    </p>
                </div>

            </div>

            <a href="./website/signup.php" class="btn-1"><?php echo $palabras['index']['primer_horario']?></a>

        </div>

    </section>
    <section class="idioma">
        <div class="idiomas">
            <?php
                include 'idiomas/lista_idiomas.php';
            ?>
        <br>
        </div>
        </section>
</body>
</html>