<?php
include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

include '../idiomas/idiomas.php';

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $nombre = $row['nombre'];
    $id = $row['id'];
}

// Consulta para obtener el horario personalizado del usuario
$queryHorario = "SELECT horario FROM tareas WHERE id_usuario = $id";
$resultHorario = $conn->query($queryHorario);

if ($rowHorario = $resultHorario->fetch_assoc()) {
    $horarioPersonalizado = $rowHorario['horario'];
} else {
    // Establecer un horario predeterminado en caso de que el usuario no tenga uno definido
    $horarioPersonalizado = '9:00-17:00';
}

// Consulta para obtener las tareas de la base de datos
$query = "SELECT * FROM tareas WHERE id_usuario = $id";
$result = $conn->query($query);

// Crear una matriz para almacenar las tareas por día y hora
$calendario = array(
    'Monday' => array(),
    'Tuesday' => array(),
    'Wednesday' => array(),
    'Thursday' => array(),
    'Friday' => array()
);

// Recorrer los resultados de la consulta y agregar las tareas al calendario
while ($row = $result->fetch_assoc()) {
    $nombreTarea = $row['tarea'];
    $importancia = $row['importancia'];
    $fecha_tarea = $row['fecha_tarea'];
    $horarioTarea = $row['horario'];

    // Obtener el día de la semana a partir de la fecha
    $diaSemana = date('l', strtotime($fecha_tarea));

    // Calcular el número de celdas que ocupará la tarea según la importancia (mínimo 1 celda)
    $numCeldas = max(1, min(6, floor($importancia / 2)));

    // Agregar la tarea al día correspondiente en el calendario
    $calendario[$diaSemana][] = array('tarea' => $nombreTarea, 'numCeldas' => $numCeldas);
}

// Obtener la hora de inicio y la hora de fin del horario personalizado
list($horaInicio, $horaFin) = explode('-', $horarioPersonalizado);
list($inicioHora, $inicioMinuto) = explode(':', $horaInicio);
list($finHora, $finMinuto) = explode(':', $horaFin);

// Convertir las horas a valores enteros
$inicioHora = intval($inicioHora);
$finHora = intval($finHora);

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
    <h1>Calendario de tareas</h1>
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
        // Generar las filas de tiempo en la tabla
        for ($hora = $inicioHora; $hora < $finHora; $hora++) {
            $horaInicio = sprintf("%02d:00", $hora);
            $horaFin = sprintf("%02d:00", $hora + 1);
            echo "<tr><td>$horaInicio - $horaFin</td>";
        }
            $diasSemana = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

            // Generar las celdas de cada día en la tabla
            foreach ($diasSemana as $diaTabla) {

                if (isset($calendario[$diaTabla]) && count($calendario[$diaTabla]) > 0) {
                    $tareaImpresa = false;

                    // Recorrer las tareas del día
                    foreach ($calendario[$diaTabla] as $index => $tarea) {
                        $numCeldasTarea = $tarea['numCeldas'];

                        // Verificar si la tarea ocupa la celda actual
                        if ($hora >= $numCeldasTarea && $hora < ($numCeldasTarea + 1)) {
                            echo "<td>".$tarea['tarea']."</td>";
                            $tareaImpresa = true;
                            break;
                        }
                    }

                    // Si no se ha impreso ninguna tarea en la celda actual, imprimir una celda vacía
                    if (!$tareaImpresa) {
                        echo "<td>".$tarea['tarea']."</td>";
                    }
                } else {
                    // Si no hay tareas para el día actual, imprimir una celda vacía
                    echo "&nbsp;";
                }

            }

            echo "</tr>";
        
        ?>
    </table>
</body>
</html>
