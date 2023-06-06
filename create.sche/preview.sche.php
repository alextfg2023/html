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
}

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
                // Imprimir la tabla del calendario
    ?>
    <!DOCTYPE html>
    <html>
    <head>
    <title><?php echo $palabras['config']['preview_title']; ?></title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #ccc;
                            padding: 8px;
            }
        </style>
    </head>
    <body>
        <?php
        $tabla_añadida = false;
        $errores = false;
        include '../complementosPHP/create.sches.php';
        if($tabla_añadida == true){
        ?>
            <div class="correct-container">
                <div class="correct-message">
                    <h1>Horarios añadidos correctamente!</h1>
                    <p>
                        <?php 
                        for ($i=0; $i < count($tablasAgregadas); $i++) { 
                            echo '<li class="info">Semana: '.$semanasTabla[$i].' --> Nombre del Horario: ' .$tablasAgregadas[$i].'</li>'; 
                        } 
                        ?>
                    </p>
                    <form method="post" action="view.sche.php">
                        <button type="submit" name="ver"><?php echo $palabras['crear_tablas']['ver_horario']?></button>
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
                <input type="checkbox" name="tablas_seleccionadas[]" value="<?php echo $numeroSemana; ?>">
                <label><?php echo $palabras['preview_tablas']['nombre']; ?> </label>
                <input type="text" name="tablas[]" placeholder="Introduce el nombre" required></input>
                <input type="hidden" name="semana_tabla[]" value="<?php echo $numeroSemana; ?>"></input>
                <br>
                <br>
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
    </body>
</html>
<?php
            }
        }
        }
?>
    <input type="submit" name="guardar" value="<?php echo $palabras['preview_tablas']['guardar']?>">
</form>
<form action="create.sche.php" method="POST">
    <input type="submit" name="Nueva_tabla" value="<?php echo $palabras['preview_tablas']['cambiar']?>">
</form>
<?php
include '../idiomas/lista_idiomas.php';
    }
?>