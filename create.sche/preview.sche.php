<?php
session_start();

include '../complementosPHP/bbdd.php';


if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $nombre = $row['nombre'];
    $id = $row['id'];
    $sexo = $row['sexo'];
    $username = $row['username'];
    $imagen = $row['imagen'];
    $email = $row['email'];
}

include '../idiomas/idiomas.php';

if (isset($_POST['generar_tabla'])) {

    $horarioPersonalizado = $_POST['horario'];
    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];

    // Crear una matriz para almacenar las tareas por día y hora
    $calendario = array(
        'Monday' => array(),
        'Tuesday' => array(),
        'Wednesday' => array(),
        'Thursday' => array(),
        'Friday' => array()
    );


// Recorrer las tareas y agregarlas al calendario
foreach ($tareas as $index => $tarea) {
    $nombreTarea = $tarea;
    $importancia = $importancias[$index];
    $fecha_tarea = $fechas[$index];

    // Obtener el día de la semana a partir de la fecha
    $diaSemana = date('l', strtotime($fecha_tarea));

    // Obtener el numero de la semana a partir de la fecha
    $numeroSemana = date('W', strtotime($fecha_tarea));

    // Calcular el número de celdas que ocupará la tarea según la importancia (máximo 6 celdas)
    $numCeldas = min(6, ceil($importancia / 2));

    // Agregar la tarea al día correspondiente en el calendario
    for ($i = 0; $i < $numCeldas; $i++) {
        $calendario[$diaSemana][$numeroSemana][] = array('tarea' => $nombreTarea);
    }

    ?>
    <form action="" method="POST">
        <?php
        echo '<input type="hidden" name="tareas[]" value="'.$tarea.'">';
        echo '<input type="hidden" name="importancias[]" value="'.$importancia.'">';
        echo '<input type="hidden" name="fechas[]" value="'.$fecha_tarea.'">';
        echo '<input type="hidden" name="semana_tarea[]" value="'.$numeroSemana.'">';
    }
    echo '<input type="hidden" name="horario" value="'.$horarioPersonalizado.'">';
    echo '<input type="hidden" name="email" value="'.$email.'">';
    echo '<input type="hidden" name="username" value="'.$username.'">';
    ?>

    <?php

    // Obtener la hora de inicio y la hora de fin del horario personalizado
    list($horaInicio, $horaFin) = explode('-', $horarioPersonalizado);
    list($inicioHora, $inicioMinuto) = explode(':', $horaInicio);
    list($finHora, $finMinuto) = explode(':', $horaFin);

    date_default_timezone_set('Europe/Madrid');

    $fechaAct = date('Y-m-d');
    $semanaAct = date('W', strtotime($fechaAct));

    $tablaGenerada = false;
    $semanaGenerada = null;
}
    // Imprimir la tabla del calendario
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <link rel="stylesheet" href="../assets/css/preview.sches.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome5.12.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['preview_title']; ?></title>
    </head>
    <body>
    <div class="wrapper">
        <div class="top_navbar">
            <div class="hamburger">
                <div class="hamburger_inner">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
            </div>
            <div class="menu">
                <div class="logo">
                    <h2><?php echo $palabras['config']['index_title'] ?></h2>
                </div>
                <div class="right_menu">
                    <ul>
                        <li>
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>" alt="profile.pic" class="fas">
                            <div class="profile_dd">
                                <div class="dd_item">
                                    <a href="../website/overview.php?id=<?php echo $id; ?>"><?php echo $palabras['home']['perfil']; ?></a>
                                </div>
                                <div class="dd_item">
                                    <a href="../complementosPHP/logout.php"><?php echo $palabras['config']['cerrar_sesion']; ?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main_container">
            <div class="sidebar">
                <div class="sidebar_inner">
                    <div class="profile">
                        <div class="img">
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>" alt="profile_pic">
                        </div>
                        <div class="profile_info">
                            <?php
                                if($sexo == 'hombre'){
                            ?>
                                <p><?php echo $palabras['general']['bienvenido']; ?></p>
                            <?php
                                }elseif($sexo == 'mujer'){
                            ?>
                                <p><?php echo $palabras['general']['bienvenida']; ?></p>
                            <?php
                                }elseif($sexo == 'otros'){
                            ?>
                                <p><?php echo $palabras['general']['bienvenid@']; ?></p>
                            <?php
                                }
                            ?>
                            <p class="profile_name"><?php echo $username;?></p>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <a href="preview.sche.php" class="active">
                                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                                <span class="title"><?php echo $palabras['preview_tablas']['tablas_prev']; ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="idiomas">
                    <?php
                        include '../idiomas/lista_idiomas.php';
                    ?>
                    </div>
                </div>

            </div>
            <?php
                $tabla_añadida = false;
                $errores = false;
                include '../complementosPHP/create.sches.php';
                if($tabla_añadida == true){
                ?>
                    <div class="correct-container">
                        <div class="correct-message">
                            <h1><?php echo $palabras['preview_tablas']['correcto']['titulo']; ?></h1>
                            <p>
                                <?php 
                                for ($i=0; $i < count($tablasAgregadas); $i++) { 
                                    echo '<li class="info">'.$palabras['preview_tablas']['correcto']['semana'].$semanasTabla[$i].$palabras['preview_tablas']['correcto']['texto'].$tablasAgregadas[$i].'</li>'; 
                                } 
                                ?>
                            </p>
                            <br>
                            <form method="post" action="view.sche.php">
                                <div class="correct-button">
                                    <input type="submit" name="ver" value="<?php echo $palabras['crear_tablas']['ver_horario']?>"/>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php 
                } elseif($errores == true){ 
                ?> 
                <div class="error-container">
                    <div class="error-message">
                        <h1><?php echo $palabras['registro']['errores']['titulo_error'] ?></h1>
                        <br>
                        <p><?php for ($i=0; $i < count($campos); $i++) { echo '<li class="info">'.$campos[$i].'</li>'; } ?></p>
                        <br>
                        <form action="signup.php">
                        <div class="error-button">
                            <input type="submit" value="<?php echo $palabras['registro']['errores']['reintentar_registro'] ?>">
                        </div>
                        </form>
                        <p class="a"><b><a class="a" href="signup.php"><?php  ?></a></b></p>
                    </div>
                </div>
            <?php 
            } else { 
            ?>
            <div class="container">
                <div class="item">
                    <center>
                    <?php
                        foreach ($fechas as $index => $fecha) {
                        $numeroSemana = date('W', strtotime($fecha));

                        if ($numeroSemana == $semanaAct || $numeroSemana > $semanaAct) {
                            if ($semanaGenerada !== $numeroSemana) {
                                $tablaGenerada = true;
                                $semanaGenerada = $numeroSemana;?>
                                <h1>
                                    <?php 
                                    echo $palabras['preview_tablas']['titulo']; 
                                    echo $numeroSemana; 
                                    ?>
                                </h1>
                                <div class="input-container">
                                    <input type="checkbox" name="tablas_seleccionadas[]" value="<?php echo $numeroSemana; ?>">
                                    <div class="input-box">
                                        <input type="text" name="tablas[]" placeholder="<?php echo $palabras['preview_tablas']['place']; ?>" required></input>
                                        <input type="hidden" name="semana_tabla[]" value="<?php echo $numeroSemana; ?>"></input>
                                    </div>
                                </div>
                                <br>
                                <br>
                            <table>
                                <tr>
                                    <th class="grande"><?php echo $palabras['preview_tablas']['horas']?></th>
                                    <th class="grande"><?php echo $palabras['preview_tablas']['lunes']?></th>
                                    <th class="grande"><?php echo $palabras['preview_tablas']['martes']?></th>
                                    <th class="grande"><?php echo $palabras['preview_tablas']['miercoles']?></th>
                                    <th class="grande"><?php echo $palabras['preview_tablas']['jueves']?></th>
                                    <th class="grande"><?php echo $palabras['preview_tablas']['viernes']?></th>

                                    <th class="pequeño"><?php echo $palabras['view_tablas']['H']?></th>
                                    <th class="pequeño"><?php echo $palabras['view_tablas']['L']?></th>
                                    <th class="pequeño"><?php echo $palabras['view_tablas']['M']?></th>
                                    <th class="pequeño"><?php echo $palabras['view_tablas']['X']?></th>
                                    <th class="pequeño"><?php echo $palabras['view_tablas']['J']?></th>
                                    <th class="pequeño"><?php echo $palabras['view_tablas']['V']?></th>
                                </tr>
                                <?php
                                $diasSemana = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

                                // Generar las filas de tiempo
                                for ($hora = $inicioHora; $hora < $finHora; $hora++) {
                                    $horaInicio = sprintf("%02d:00", $hora);
                                    $horaFin = sprintf("%02d:00", $hora + 1);
                                    echo "<tr><td>$horaInicio - $horaFin</td>";

                                    // Generar las celdas de tareas para cada día
                                    foreach ($diasSemana as $dia) {
                                        $tareas = $calendario[$dia][$numeroSemana] ?? [];

                                        $numTareas = count($tareas);

                                        if ($numTareas > 0) {
                                            $tarea = $tareas[0]['tarea'];
                                            unset($tareas[0]);
                                            $calendario[$dia][$numeroSemana] = array_values($tareas);

                                            echo "<td>$tarea</td>";

                                        } else {
                                            echo "<td></td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                                ?>
                                </table>
                                <br>
                            <div class="button">
                                <input type="submit" name="guardar" value="<?php echo $palabras['preview_tablas']['guardar']?>">
                            </div>
                        </form>
                        <form action="create.sche.php" method="post">
                            <div class="button">
                                <input type="submit" name="Nueva_tabla" value="<?php echo $palabras['preview_tablas']['cambiar']?>"/>
                            </div>
                        </form> 
                    </center>
                </div>                  
            </div>
        </div>
    </div>
    <script src="../complementosJS/nav_bar.js"></script>
    </body>
</html>
<?php
            }
        }
        }
?>
<?php
    }
?>