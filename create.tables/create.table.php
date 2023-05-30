<?php
include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

include '../idiomas/idiomas.php';

if (isset($_POST['Generar_tabla'])) {
    $horarioPersonalizado = $_POST['horario'];
    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];
    $id = $_POST['id'];

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
    <br>
        <form action="" method="POST">
            <input type="submit" name="Nueva_tabla" value="Modificar tabla">
        </form>
</body>
</html>
<?php
} else {
    // Si no se ha enviado el formulario, mostrar el formulario de creación
?>
<!DOCTYPE html>
<html>
<head>
    <title>Generar horario de trabajo</title>
    <style>
        .tarea {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Generar horario de trabajo</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="horario">Horario:</label>
        <input type="text" name="horario" id="horario" placeholder="Ej. 9:00-18:00" required><br><br>

        <div id="tareas">
            <div class="tarea">
                <label for="tarea1">Tarea:</label>
                <input type="text" name="tareas[]" id="tarea1" required>
                <label for="importancia1">Importancia:</label>
                <input type="number" name="importancias[]" id="importancia1" min="1" max="10" required>
                <label for="fecha1">Fecha:</label>
                <input type="date" name="fechas[]" id="fecha1" required>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
        </div><br>

        <button type="button" id="agregar_tarea">Agregar tarea</button><br><br>

        <button type="submit" name="Generar_tabla">Generar horario</button><br><br>
    </form>

    <form method="post" action="../website/home.php">
        <button type="submit" name="Volver">Volver</button>
    </form>

    <script>
        // Agregar nueva tarea al formulario
        let numTareas = 1;
        document.getElementById("agregar_tarea").addEventListener("click", function() {
            numTareas++;

            let divTarea = document.createElement("div");
            divTarea.className = "tarea";

            let labelTarea = document.createElement("label");
            labelTarea.textContent = "Tarea:";
            let inputTarea = document.createElement("input");
            inputTarea.type = "text";
            inputTarea.name = "tareas[]";
            inputTarea.id = "tarea" + numTareas;
            inputTarea.required = true;

            let labelImportancia = document.createElement("label");
            labelImportancia.textContent = "Importancia:";
            let inputImportancia = document.createElement("input");
            inputImportancia.type = "number";
            inputImportancia.name = "importancias[]";
            inputImportancia.id = "importancia" + numTareas;
            inputImportancia.min = "1";
            inputImportancia.max = "10";
            inputImportancia.required = true;

            let labelFecha = document.createElement("label");
            labelFecha.textContent = "Fecha:";
            let inputFecha = document.createElement("input");
            inputFecha.type = "date";
            inputFecha.name = "fechas[]";
            inputFecha.id = "fecha" + numTareas;
            inputFecha.required = true;

            divTarea.appendChild(labelTarea);
            divTarea.appendChild(inputTarea);
            divTarea.appendChild(labelImportancia);
            divTarea.appendChild(inputImportancia);
            divTarea.appendChild(labelFecha);
            divTarea.appendChild(inputFecha);

            document.getElementById("tareas").appendChild(divTarea);
        });
    </script>
</body>
</html>
<?php
}
?>