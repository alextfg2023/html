<?php
if (isset($_POST['guardar'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];

    $buscar_id = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '$email' OR username = '$username'");

    if (mysqli_num_rows($buscar_id) > 0) {
        $row = mysqli_fetch_assoc($buscar_id);
        $id = $row['id'];
    }

    $tabla_añadida = false;
    $errores = false;

    if (isset($_POST['semana_tabla'])) {
        $semanasTabla = $_POST['semana_tabla'];
    }

    $tablas = $_POST['tablas'];
    $tablas_seleccionadas = $_POST['tablas_seleccionadas'];
    $horario = $_POST['horario'];
    $tablasAgregadas = [];
    $tareasAgregadas = [];

    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];
    $campos = array();

    foreach ($tablas as $index => $tabla) {
        $tabla_añadida = true;
        $nombreTabla = $tabla;
        $semanaTabla = $semanasTabla[$index]; // Obtener la semana de la tabla actual

        if (isset($tablas_seleccionadas) && in_array($semanaTabla, $tablas_seleccionadas)) {
            $insert_tablas = mysqli_query($conn, "INSERT INTO tablas (nombre, id_usuario, horario, semana) VALUES ('$nombreTabla', '$id', '$horario', '$semanaTabla')");

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

                    // Verificar si la semana de la tarea coincide con la semana de la tabla actual
                    $numeroSemanaTarea = date('W', strtotime($fechaTarea));

                    if ($numeroSemanaTarea == $semanaTabla) {
                        // Insertar la tarea en la base de datos con el id_tabla obtenido
                        $query = "INSERT INTO tareas (tarea, importancia, fecha_tarea, id_tabla) VALUES ('$nombreTarea', $importancia, '$fechaTarea', $tablaId)";
                        $insert_tareas = mysqli_query($conn, $query);

                        if ($insert_tareas) {
                            $tareasAgregadas[] = $nombreTarea; // Agregar la tarea al array de tareas agregadas
                            $tareasTabla[] = $nombreTarea; // Agregar la tarea al array de tareas correspondientes a la tabla actual
                        }
                    }
                }
            }
        }
    } 
    if(mysqli_error($conn)){
        $errores = true;
    }
}
?>
