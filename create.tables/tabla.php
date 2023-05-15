<?php
// Obtener los datos del formulario
$horario = $_POST['horario'];
$tareas = $_POST['tareas'];
$importancias = $_POST['importancias'];

// Función para calcular el tiempo máximo que puede durar una tarea en base a su importancia
function calcularTiempo($importancia) {
    return round(($importancia / 10) * 6, 0);
}

// Calcular el número de tareas
$numTareas = count($tareas);

// Calcular el tiempo máximo para cada tarea
$tiemposMaximos = array();
for ($i = 0; $i < $numTareas; $i++) {
$tiemposMaximos[$i] = calcularTiempo($importancias[$i]);
}

// Obtener la hora de inicio y fin del horario
list($horaInicio, $horaFin) = explode("-", $horario);
$horaInicio = strtotime($horaInicio);
$horaFin = strtotime($horaFin);

// Calcular el número de horas disponibles
$horasDisponibles = round(($horaFin - $horaInicio) / 3600, 1);

// Calcular el tiempo que se debe asignar a cada tarea en base a su importancia
$tiempos = array();
$tiempoTotal = 0;
for ($i = 0; $i < $numTareas; $i++) {
    $tiempos[$i] = min($tiemposMaximos[$i], $horasDisponibles - $tiempoTotal);
    $tiempoTotal += $tiempos[$i];
}

// Generar el horario
$horaActual = $horaInicio;
echo '<table>';
echo '<tr><th>Hora</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th></tr>';
for ($i = 0; $i < $numTareas; $i++) {
    // Obtener la hora de inicio y fin de la tarea
    $horaInicioTarea = date('H:i', $horaActual);
    $horaFinTarea = date('H:i', strtotime("+$tiempos[$i] hours", $horaActual));
    // Mostrar la tarea en la tabla
    echo "<tr><td>$horaInicioTarea - $horaFinTarea</td><td>$tareas[$i]</td></tr>";

    // Actualizar la hora actual para la siguiente tarea
    $horaActual = strtotime("+$tiempos[$i] hours", $horaActual);
}
echo '</table>';
