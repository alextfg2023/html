<!DOCTYPE html>
<html>
<head>
    <title>Tabla con PHP</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Columna 1</th>
                <th>Columna 2</th>
                <th>Columna 3</th>
                <th>Columna 4</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Valor a mostrar en la columna 1
            $valor = "X";
            
            // Importancia (número de celdas en la columna 1)
            $importancia = 2;
            
            // Número de filas y columnas
            $filas = 6;
            $columnas = 5;
            
            // Calcular el número de celdas necesarias en la columna 1
            $celdasColumna1 = $filas - $importancia;
            
            // Generar las filas y columnas de la tabla
            for ($i = 1; $i <= $filas; $i++) {
                echo "<tr>";
                
                for ($j = 1; $j <= $columnas; $j++) {
                    if ($j === 1 && $i <= $celdasColumna1) {
                        if ($i <= $celdasColumna1) {
                            echo "<td>$valor</td>";
                        } else {
                            echo "<td></td>";
                        }
                    } else {
                        echo "<td></td>";
                    }
                }
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>








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
    $importancia = intval($row['importancia']);
    $fecha_tarea = $row['fecha_tarea'];
    $horarioTarea = $row['horario'];

    // Obtener el día de la semana a partir de la fecha
    $diaSemana = date('l', strtotime($fecha_tarea));

    // Calcular el número de celdas que ocupará la tarea según la importancia (máximo 6 celdas)
    $numCeldas = min(6, ceil($importancia / 2));
    
    // Agregar la tarea al día correspondiente en el calendario
    $calendario[$diaSemana][] = array('tarea' => $nombreTarea, 'numCeldas' => $numCeldas);
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
                    $numCeldas = count($tareas);

                    if ($numCeldas > 0) {
                        $tarea = $tareas[0]['tarea'];
                        $numCeldas = $tareas[0]['numCeldas'];
                        unset($tareas[0]);
                        $calendario[$dia] = array_values($tareas);

                        if ($numCeldas > 0) {
                            echo "<td >$tarea</td>";
                        }

                        $numCeldas--;
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
