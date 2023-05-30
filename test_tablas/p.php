<?php
include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

include '../idiomas/idiomas.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $horarioPersonalizado = $_POST['horario'];
    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];
    $id = $_POST['id'];
}
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
        $importancia = intval($importancias[$index]);
        $fecha_tarea = $fechas[$index];

        // Obtener el día de la semana a partir de la fecha
        $diaSemana = date('l', strtotime($fecha_tarea));

        // Calcular el número de celdas que ocupará la tarea según la importancia (máximo 6 celdas)
        $numCeldas = min(6, ceil($importancia / 2));

        // Agregar la tarea al día correspondiente en el calendario
        for ($i = 0; $i < $numCeldas; $i++) {
            $calendario[$diaSemana][] = array('tarea' => $nombreTarea);
        }
    }

    // Obtener la hora de inicio y la hora de fin del horario personalizado
    list($horaInicio, $horaFin) = explode('-', $horarioPersonalizado);
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
            $diasSemana = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
            
            // Generar las filas de tiempo
            for ($hora = $inicioHora; $hora < $finHora; $hora++) {
                $horaInicio = sprintf("%02d:00", $hora);
                $horaFin = sprintf("%02d:00", $hora + 1);
                echo "<tr><td>$horaInicio - $horaFin</td>";
                
                // Generar las celdas de tareas para cada día
                foreach ($diasSemana as $dia) {
                    $tareas = $calendario[$dia] ?? [];
                    $numTareas = count($tareas);

                    if ($numTareas > 0) {
                        $tarea = $tareas[0]['tarea'];
                        unset($tareas[0]);
                        $calendario[$dia] = array_values($tareas);

                        echo "<td>$tarea</td>";
                    } else {
                        echo "<td></td>";
                    }
                }

                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>