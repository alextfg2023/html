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
    $tipo = $row['tipo'];
}

include '../idiomas/idiomas.php';

$querytablas = mysqli_query($conn, "SELECT * FROM tablas WHERE id_usuario = '$id'");

if (mysqli_num_rows($querytablas) > 0) {

    $calendarios = array();

    while ($rowTabla = mysqli_fetch_assoc($querytablas)) {
        $nombre_tabla = $rowTabla['nombre'];
        $id_tabla = $rowTabla['id'];
        $horarioPersonalizado = $rowTabla['horario'];
        $numeroSemana = $rowTabla['semana'];

        $calendario = array(
            'Monday' => array(),
            'Tuesday' => array(),
            'Wednesday' => array(),
            'Thursday' => array(),
            'Friday' => array()
        );

        $querytareas = mysqli_query($conn, "SELECT * FROM tareas WHERE id_tabla = '$id_tabla'");

        while ($rowTarea = mysqli_fetch_assoc($querytareas)) {
            $nombreTarea = $rowTarea['tarea'];
            $importancia = $rowTarea['importancia'];
            $fecha_tarea = $rowTarea['fecha_tarea'];

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
        }

        $calendarios[] = array(
            'nombre_tabla' => $nombre_tabla,
            'id_tabla' => $id_tabla,
            'horarioPersonalizado' => $horarioPersonalizado,
            'calendario' => $calendario
        );
    }


    // Obtener el índice actual del calendario
    $indiceCalendario = isset($_GET['indice']) ? $_GET['indice'] : 0;
    $calendarioActual = $calendarios[$indiceCalendario];

    // Obtener el número total de calendarios
    $totalCalendarios = count($calendarios);

    // Obtener los índices del calendario anterior y siguiente
    $indiceAnterior = ($indiceCalendario - 1 + $totalCalendarios) % $totalCalendarios;
    $indiceSiguiente = ($indiceCalendario + 1) % $totalCalendarios;

    // Obtener la información del calendario actual
    $nombre_tabla = $calendarioActual['nombre_tabla'];
    $id_tabla = $calendarioActual['id_tabla'];
    $horarioPersonalizado = $calendarioActual['horarioPersonalizado'];
    $calendario_dias = $calendarioActual['calendario'];

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

    if (isset($_POST['buscarTabla'])) {
        $nombreBuscado = $_POST['buscarTabla'];

        foreach ($calendarios as $indice => $calendario) {
            if ($calendario['nombre_tabla'] === $nombreBuscado) {
                $calendarioActual = $calendario;
                $indiceCalendario = $indice;
                $tablaGenerada = true;
                $semanaGenerada = null;
                break;
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title><?php echo $palabras['config']['view_title']; ?></title>
        <link rel="stylesheet" href="../assets/css/view.sche.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome5.12.1/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
                            <a href="../website/home.php?id=<?php echo $id; ?>">
                                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                                <?php
                                    if($tipo == 'ambos'){
                                ?>
                                    <span class="title"><?php echo $palabras['home']['calendarios']; ?></span>
                                <?php
                                    }else{
                                ?>
                                    <span class="title"><?php echo $palabras['home']['calendario']; ?></span>
                                <?php
                                    }
                                ?>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="create.sche.php?id=<?php echo $id; ?>">
                                <span class="icon"><i class="fas fa-calendar-plus"></i></span>
                                <span class="title"><?php echo $palabras['home']['tablas_c']; ?></span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="view.sche.php" class="active">
                                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                                <span class="title"><?php echo $palabras['home']['tablas_v']; ?></span>
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
            <div class="container">
                <div class="item">
                    <?php
                    if(isset($_POST['borrar'])){
                        $id_borr = $_POST['id_tabla_borr'];
                        $nombre_borr = $_POST['nombre_tabla_borr'];
                        ?>
                        <div class="error-container">
                            <div class="error-message">
                                <h1><?php echo $palabras['view_tablas']['borrar_tabla']['titulo']; ?></h1>
                                <br>
                                <p><?php echo $palabras['view_tablas']['borrar_tabla']['texto']; echo $nombre_borr; ?></p>
                                <p><?php echo $palabras['view_tablas']['borrar_tabla']['aviso']?></p>
                                <p><?php echo $palabras['view_tablas']['borrar_tabla']['seguro']?></p>
                                <br>
                                <form method="post" action="../complementosPHP/delete.sche.php">
                                <div class="error-button">
                                        <input type="submit" name="borrar_def" value="<?php echo $palabras['view_tablas']['borrar_tabla']['borrar']; ?>">
                                        <input type="hidden" name="id_tabla_borrar" value="<?php echo $id_tabla; ?>">
                                        <input type="hidden" name="nombre_tabla_borrar" value="<?php echo $nombre_borr; ?>">
                                        <input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
                                </div>
                                </form>
                                <br>
                                <form action="">
                                <div class="error-button">
                                        <input type="submit" value="<?php echo $palabras['view_tablas']['borrar_tabla']['retroceder']; ?>">
                                </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }elseif(mysqli_num_rows($querytablas) > 0){
                    ?>
                    <center>
                    <?php 
                        if ($tablaGenerada || empty($_POST['buscarTabla'])) { ?> 
                        <br>
                        <h1>
                            <?php 
                                if (isset($_POST['buscarTabla'])) {

                                    $nombre_tabla = $_POST['buscarTabla'];
                                    
                                    echo $nombre_tabla;
                                } else {
                                    echo $nombre_tabla;
                                }
                            ?>
                        </h1>
                        <br>
                    </center>
                        <?php
                        $diasSemana = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
                        $calendario_dias = $calendarioActual['calendario'];
                        ?>
                        <table>
                            <tr>
                                <th class="grande"><?php echo $palabras['view_tablas']['horas']?></th>
                                <th class="grande"><?php echo $palabras['view_tablas']['lunes']?></th>
                                <th class="grande"><?php echo $palabras['view_tablas']['martes']?></th>
                                <th class="grande"><?php echo $palabras['view_tablas']['miercoles']?></th>
                                <th class="grande"><?php echo $palabras['view_tablas']['jueves']?></th>
                                <th class="grande"><?php echo $palabras['view_tablas']['viernes']?></th>
                                <th class="pequeño"><?php echo $palabras['view_tablas']['H']?></th>
                                <th class="pequeño"><?php echo $palabras['view_tablas']['L']?></th>
                                <th class="pequeño"><?php echo $palabras['view_tablas']['M']?></th>
                                <th class="pequeño"><?php echo $palabras['view_tablas']['X']?></th>
                                <th class="pequeño"><?php echo $palabras['view_tablas']['J']?></th>
                                <th class="pequeño"><?php echo $palabras['view_tablas']['V']?></th>
                            </tr>

                            <?php
                            // Generar las filas de tiempo
                            for ($hora = $inicioHora; $hora < $finHora; $hora++) {
                                $horaInicio = sprintf("%02d:00", $hora);
                                $horaFin = sprintf("%02d:00", $hora + 1);
                                echo "<tr><td>$horaInicio - $horaFin</td>";

                                // Generar las celdas de tareas para cada día
                                foreach ($diasSemana as $diaSemana) {
                                    echo "<td>";
                                    $semanas = $calendario_dias[$diaSemana];

                                    // Recorrer las semanas
                                    foreach ($semanas as $semana => $tareas) {
                                        $numTareas = count($tareas);

                                        if ($numTareas > 0) {
                                            $tarea = $tareas[0]['tarea'];
                                            unset($calendario_dias[$diaSemana][$semana][0]);
                                            $calendario_dias[$diaSemana][$semana] = array_values($calendario_dias[$diaSemana][$semana]);

                                            echo $tarea;

                                        } else {
                                            echo "-";
                                        }
                                    }

                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    <br>
                    <div class="button-container">
                        <form method="get" action="">
                            <input type="hidden" name="indice" value="<?php echo $indiceAnterior; ?>">
                            <div class="button">
                                <input type="submit" name="anterior" value="<?php echo $palabras['view_tablas']['anterior']; ?>"/>
                            </div>
                        </form>
                        <form method="post" action="">
                            <div class="delete">
                                <input type="submit" name="borrar" value="<?php echo $palabras['view_tablas']['borrar']; ?>"/>
                            </div>
                            <input type="hidden" name="id_tabla_borr" value="<?php echo $id_tabla; ?>">
                            <input type="hidden" name="nombre_tabla_borr" value="<?php echo $nombre_tabla; ?>">
                        </form>
                        <form method="get" action="">
                            <input type="hidden" name="indice" value="<?php echo $indiceSiguiente; ?>">
                            <div class="button">
                                <input type="submit" name="siguiente" value="<?php echo $palabras['view_tablas']['siguiente']; ?>"/>
                            </div>
                        </form>
                    </div>
                    <center>
                        <form method="post" action="">
                            <div class="input-box">
                                <input type="text" name="buscarTabla" placeholder="<?php echo $palabras['view_tablas']['buscar_place']; ?>" value="<?php echo isset($_POST['buscarTabla']) ? $_POST['buscarTabla'] : ''; ?>">
                            </div>
                            <div class="button">
                                <input type="submit" name="buscartabla" value="<?php echo $palabras['view_tablas']['buscar']; ?>"/>
                            </div>
                        </form> 
                    </center>
                    <?php 
                        } 
                    }else {
                    ?>
                    <div class="error-container">
                        <div class="error-message">
                            <h1><?php echo $palabras['view_tablas']['no_tablas'] ?></h1>
                            <br>
                            <p><?php echo $palabras['view_tablas']['mensaje_no_tablas1']?></p>
                            <br>
                            <p>
                                <?php echo $palabras['view_tablas']['mensaje_no_tablas2']?>
                                <b>
                                    <a href="create.sche.php" class="a">
                                        <?php echo $palabras['view_tablas']['enlace_no_tablas1'] ?>
                                    </a>
                                </b>
                                <?php echo $palabras['view_tablas']['mensaje_no_tablas3']?>
                                <b>
                                    <a href="../website/home.php" class="a">
                                        <?php echo $palabras['view_tablas']['enlace_no_tablas2'] ?>
                                    </a>
                                </b>
                            </p>
                        </div>
                    </div>
                    <?php
                        } 
                    ?>
                </div>                  
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Verifica si la pantalla es lo suficientemente grande para ejecutar el script
            if (window.matchMedia("(min-width: 584px)").matches) {
                // Código a ejecutar solo en pantallas grandes
                $(".hamburger").click(function(){
                    $(".wrapper").toggleClass("active");
                });
            }
            $(".right_menu li .fas").click(function(){
                    $(".profile_dd").toggleClass("active");
                });
        });
    </script>
</body>
</html>