<?php
// Obtener los datos del formulario
include '../complementosPHP/bbdd.php';

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $horario = $_POST['horario'];
    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];

    // Insertar las tareas en la base de datos
    for ($i = 0; $i < count($tareas); $i++) {
        $nombreTarea = $conn->real_escape_string($tareas[$i]);
        $importancia = intval($importancias[$i]);
        $fecha = $conn->real_escape_string($fechas[$i]);

        $tareas_add = $conn->query("INSERT INTO tareas (id_usuario, tarea, importancia, fecha_tarea, horario)
        VALUES ('$id', '$nombreTarea', '$importancia', '$fecha', '$horario')")or die($conn->$error);

        echo 'Tarea '.$nombreTarea.' creada correctamente para el dia '.$fecha.'<br>';

        if ($tareas_add !== TRUE) {

            echo "Error al insertar la tarea: " . $conn->error;
        }
    }
    echo 'Para ver tu tabla ver <a href="ver_tabla.php">Aquí</a>';
}
    ?>
