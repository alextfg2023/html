<?php
include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

if (isset($_POST['guardar'])) {
    $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $id = $row['id'];
    }

    $tablas = $_POST['tablas'];
    $horario = $_POST['horario'];
    $tablasAgregadas = [];
    $tareasAgregadas = []; // Array para almacenar las tareas agregadas

    $tareas = $_POST['tareas']; // Obtener los valores de las tareas fuera del bucle de las tablas
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];
    
    foreach ($tablas as $index => $tabla) {
        $nombreTabla = $tabla;

        $insert_tablas = mysqli_query($conn, "INSERT INTO tablas (nombre, id_usuario, horario) VALUES ('$nombreTabla', '$id', '$horario')") or die($conn->error);

        if ($insert_tablas) {
            $tablaId = mysqli_insert_id($conn); // Obtener el ID de la tabla recién insertada
            $tablasAgregadas[] = $nombreTabla;

            // Insertar las tareas en la base de datos
            $tareasTabla = []; // Array para almacenar las tareas correspondientes a la tabla actual

            foreach ($tareas as $taskIndex => $tarea) {
                $nombreTarea = $tarea;
                $importancia = $importancias[$taskIndex];
                $fechaTarea = $fechas[$taskIndex];
                $tablaIndex = $index; // Índice de la tabla actual

                if ($tablaIndex == $index) {
                    // Insertar la tarea en la base de datos con el id_tabla obtenido
                    $query = "INSERT INTO tareas (tarea, importancia, fecha_tarea, id_tabla) VALUES ('$nombreTarea', $importancia, '$fechaTarea', $tablaId)";
                    $insert_tareas = mysqli_query($conn, $query);

                    if ($insert_tareas) {
                        $tareasAgregadas[] = $nombreTarea; // Agregar la tarea al array de tareas agregadas
                        $tareasTabla[] = $nombreTarea; // Agregar la tarea al array de tareas correspondientes a la tabla actual
                    } else {
                        echo "Error al agregar la tarea $nombreTarea: " . mysqli_error($conn);
                    }
                }
            }

            // Mostrar las tareas agregadas para la tabla actual
            if (!empty($tareasTabla)) {
                echo "Las tareas para la tabla $nombreTabla: " . implode(", ", $tareasTabla) . " se han agregado correctamente<br>";
            }
        } else {
            echo "Error al agregar la tabla $nombreTabla: " . mysqli_error($conn);
        }
    }

    if (!empty($tablasAgregadas)) {
        echo "Las tablas: " . implode(", ", $tablasAgregadas) . " se han agregado correctamente<br>";
    }

    if (!empty($tareasAgregadas)) {
        echo "Las tareas: " . implode(", ", $tareasAgregadas) . " se han agregado correctamente";
    }
}
?>
