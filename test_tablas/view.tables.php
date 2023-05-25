<?php
include '../complementosPHP/bbdd.php';
session_start();

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
}

include '../idiomas/idiomas.php';

if (isset($_POST['Generar_tabla'])) {
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
        <form action="../complementosPHP/create.tables.php" method="POST">
    <?php
    echo '<input type="text" name="tareas[]" value='.$nombreTarea.'>';
    echo '<input type="text" name="importancias[]" value='.$importancia.'>';
    echo '<input type="text" name="fechas[]" value='.$fecha_tarea.'>';
}
    echo '<input type="text" name="horario" value='.$horarioPersonalizado.'>';

// Obtener la hora de inicio y la hora de fin del horario personalizado
list($horaInicio, $horaFin) = explode('-', $horarioPersonalizado);
list($inicioHora, $inicioMinuto) = explode(':', $horaInicio);
list($finHora, $finMinuto) = explode(':', $horaFin);

date_default_timezone_set('Europe/Madrid');

$fechaAct = date('Y-m-d');
$semanaAct = date('W', strtotime($fechaAct));

$tablaGenerada = false;
$semanaGenerada = null;

foreach ($fechas as $fecha) {
    $numeroSemana = date('W', strtotime($fecha));

    if ($numeroSemana == $semanaAct || $numeroSemana > $semanaAct) {
        if ($semanaGenerada !== $numeroSemana) {
            $tablaGenerada = true;
            $semanaGenerada = $numeroSemana;

            // Imprimir la tabla del calendario
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Calendario de tareas</title>
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
                <?php include '../complementosPHP/create.tables.php'; ?>
                <h1>Horario Semana: <?php echo $numeroSemana; ?></h1>
                    <label>Nombre del horario: </label>
                    <input type="text" name="tablas[]" placeholder="Introduce el nombre"></input>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <th>Tiempo</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
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
<input type="submit" name="guardar" value="Guardar tabla">
</form>
<form action="create.table.php" method="POST">
    <input type="submit" name="Nueva_tabla" value="Modificar tabla">
</form>
<?php
if (!$tablaGenerada) {
    ?>
    <div class="error-container">
        <div class="error-message">
            <h1>Ocurrió un error</h1>
            <br>
            <h3>La tarea introducida es anterior a la fecha actual, por favor introduce la fecha de hoy o posterior</h3>
            <br>
            <form action="create.table.php">
                <div class="error-button">
                    <input type="submit" value="<?php echo $palabras['recuperar_pass']['cambiar_pass']['error']['boton'] ?>">
                </div>
            </form>
        </div>
    </div>
<?php
} else if (isset($_POST['crear'])) {
    $nombre_tabla = $_POST['nombre_tabla'];

    $insert = mysqli_query($conn, "INSERT INTO tablas (nombre, id_usuario) VALUES ('$nombre_tabla', '$id')") or die($conn->error);
    
    if ($insert) {
        $tablaId = mysqli_insert_id($conn);

        $select = mysqli_query($conn, "SELECT id FROM tablas WHERE id = '$tablaId'");

        if (mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            $id_tabla = $row['id'];

            echo "Tabla ".$nombre_tabla." agregada correctamente<br>";
            echo "ID de la tabla: $id_tabla";
        }
    }
}




    

    /*// Obtener las tareas enviadas por el formulario
    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];

    // Insertar las tareas en la base de datos
    foreach ($tareas as $index => $tarea) {
        $nombreTarea = mysqli_real_escape_string($conn, $tarea);
        $importancia = intval($importancias[$index]);
        $fechaTarea = mysqli_real_escape_string($conn, $fechas[$index]);

        // Insertar la tarea en la base de datos
        $query = "INSERT INTO tareas (tarea, importancia, fecha_tarea, horario, id_tabla) VALUES ('$nombreTarea', $importancia, '$fechaTarea', '$nombreTabla')";
        mysqli_query($conn, $query);
    }*/


?>