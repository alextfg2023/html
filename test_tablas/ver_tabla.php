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

// Consulta para obtener las tareas de la base de datos
$query = "SELECT * FROM tareas WHERE id_usuario = $id";
$result = $conn->query($query);

// Crear una matriz para almacenar las tareas por día y hora
$calendario = array(
    'Lunes' => array(),
    'Martes' => array(),
    'Miércoles' => array(),
    'Jueves' => array(),
    'Viernes' => array()
);

// Recorrer los resultados de la consulta y agregar las tareas al calendario
while ($row = $result->fetch_assoc()) {
    $nombreTarea = $row['tarea'];
    $importancia = intval($row['importancia']);
    $fecha = $row['fecha_tarea'];
    $horario = $row['horario'];

    // Obtener el día de la semana a partir de la fecha
    $diaSemana = date('l', strtotime($fecha));

    // Calcular la duración en horas según la importancia (asumiendo 6 horas por unidad de importancia)
    $duracion = 6 * $importancia;

    // Agregar la tarea al día correspondiente en el calendario
    $calendario[$diaSemana][] = array('tarea' => $nombreTarea, 'duracion' => $duracion);
}

// Obtener la hora de inicio y la hora de fin del horario personalizado
list($horaInicio, $horaFin) = explode('-', $horario);
list($inicioHora, $inicioMinuto) = explode(':', $horaInicio);
list($finHora, $finMinuto) = explode(':', $horaFin);

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
        // Obtener el número máximo de filas en el calendario
        $maxFilas = max(array_map('count', $calendario));

        // Generar las filas de tiempo en la tabla
        for ($hora = $inicioHora; $hora <= $finHora; $hora++) {
            $horaInicio = sprintf("%02d:00", $hora);
            $horaFin = sprintf("%02d:00", $hora + 1);
            echo "<tr><td>$horaInicio - $horaFin</td>";

            $diasSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');

            // Generar las celdas de cada día en la tabla
            foreach ($diasSemana as $dia) {
                echo "<td>";
                // Verificar si hay tareas para el día y hora actual
                if (isset($calendario[$dia]) && isset($calendario[$dia][$hora - $inicioHora])) {
                    $tarea = $calendario[$dia][$hora - $inicioHora]['tarea'];
                    $duracion = $calendario[$dia][$hora - $inicioHora]['duracion'];
                    echo "<span>$tarea</span><br>";
                    echo "<span>Duración: $duracion horas</span>";
                }
                echo "</td>";
            }

            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>


