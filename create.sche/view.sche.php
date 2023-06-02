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
        <link rel="stylesheet" href="../assets/css/view_sche.css">
    </head>
    <body>
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
        <div class="container">
            <form method="post" action="">
                <input type="text" name="buscarTabla" placeholder="Buscar tabla..." value="<?php echo isset($_POST['buscarTabla']) ? $_POST['buscarTabla'] : ''; ?>">
                <button type="buscartabla">Buscar</button>
            </form> 
            <?php 
                if ($tablaGenerada || empty($_POST['buscarTabla'])) { ?> 
            <div class="table-container">
            <center>
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
            </center>
                <?php
                $diasSemana = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
                $calendario_dias = $calendarioActual['calendario'];
                ?>
                <table>
                    <tr>
                        <th><?php echo $palabras['preview_tablas']['horas']?></th>
                        <th><?php echo $palabras['preview_tablas']['lunes']?></th>
                        <th><?php echo $palabras['preview_tablas']['martes']?></th>
                        <th><?php echo $palabras['preview_tablas']['miercoles']?></th>
                        <th><?php echo $palabras['preview_tablas']['jueves']?></th>
                        <th><?php echo $palabras['preview_tablas']['viernes']?></th>
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
            </div>
            <br>
            <div class="button-container">
                <form method="get" action="">
                    <input type="hidden" name="indice" value="<?php echo $indiceAnterior; ?>">
                    <button type="submit" name="anterior" class="button"><?php echo $palabras['view_tablas']['anterior']; ?></button>
                </form>
                <form method="post" action="">
                    <button type="submit" name="borrar" class="delete"><?php echo $palabras['view_tablas']['borrar']; ?></button>
                    <input type="hidden" name="id_tabla_borr" value="<?php echo $id_tabla; ?>">
                    <input type="hidden" name="nombre_tabla_borr" value="<?php echo $nombre_tabla; ?>">
                </form>
                <form method="get" action="">
                    <input type="hidden" name="indice" value="<?php echo $indiceSiguiente; ?>">
                    <button type="submit" name="siguiente" class="button"><?php echo $palabras['view_tablas']['siguiente']; ?></button>
                </form>
            </div>
        </div>
        <form method="post" action="../website/home.php">
            <button type="submit"><?php echo $palabras['view_tablas']['volver']; ?></button>
        </form>
        <br>
    <?php 
        include '../idiomas/lista_idiomas.php';
        } 
    }else {
    ?>
        <div class="no-contenedor">
            <div class="no-message">
                <h1><?php echo $palabras['view_tablas']['no_tablas'] ?></h1>
                <p><?php echo $palabras['view_tablas']['mensaje_no_tablas1']?></p>
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
</body>
</html>