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
    $tblasAgregadas = [];
    foreach ($tablas as $index => $tabla){

        $nombreTabla = $tabla;

        $insert_tablas = mysqli_query($conn, "INSERT INTO tablas (nombre, id_usuario, horario) VALUES ('$nombreTabla', '$id', '$horario')") or die($conn->error);

        if ($insert_tablas) {
            $tablaId = mysqli_insert_id($conn);
            $tablasAgregadas[] = $nombreTabla;
        }else{
            echo "Error al agregar la tabla $nombreTabla: " . mysqli_error($conn);
        }

        $tareas = $_POST['tareas'];
        $importancias = $_POST['importancias'];
        $fechas = $_POST['fechas'];
    
        $tareasAgregadas = []; // Array para almacenar las tareas agregadas
    
        // Insertar las tareas en la base de datos
        foreach ($tareas as $index => $tarea) {
            $nombreTarea = $tarea;
            $importancia = $importancias[$index];
            $fechaTarea = $fechas[$index];
    
            // Insertar la tarea en la base de datos con el id_tabla obtenido
            $query = "INSERT INTO tareas (tarea, importancia, fecha_tarea, id_tabla) VALUES ('$nombreTarea', $importancia, '$fechaTarea', $tablaId)";
            $insert_tareas = mysqli_query($conn, $query);
    
            if ($insert_tareas) {
                $tareasAgregadas[] = $nombreTarea; // Agregar la tarea al array de tareas agregadas
            } else {
                echo "Error al agregar la tarea $nombreTarea: " . mysqli_error($conn);
            }
        }
    }
    if (!empty($tablasAgregadas)) {
        echo "Las tablas: " . implode(", ", $tablasAgregadas) . " se han agregado correctamente <br>";
    }

    if (!empty($tareasAgregadas)) {
        echo "Las tareas:" . implode(", ", $tareasAgregadas) . " se han agregado correctamente";
    }
}
?>