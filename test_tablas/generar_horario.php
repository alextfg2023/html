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
    $stmt = $conn->prepare("INSERT INTO tareas (id_usuario, tarea, importancia, fecha_tarea, horario) VALUES (?, ?, ?, ?, ?)");

    for ($i = 0; $i < count($tareas); $i++) {
        $nombreTarea = $conn->real_escape_string($tareas[$i]);
        $importancia = intval($importancias[$i]);
        $fecha = $conn->real_escape_string($fechas[$i]);

        $stmt->bind_param("isiss", $id, $nombreTarea, $importancia, $fecha, $horario);
        $result = $stmt->execute();

        if ($result) {
            echo 'Tarea '.$nombreTarea.' creada correctamente para el día '.$fecha.'<br>';
        } else {
            echo "Error al insertar la tarea: " . $conn->error;
        }
    }

    $stmt->close();

    echo 'Para ver tu tabla ver <a href="ver_tabla.php">Aquí</a>';
}
?>
