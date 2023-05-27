<?php
include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: ../index.php");
}

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $nombre = $row['nombre'];
    $id = $row['id'];
    $sexo = $row['sexo'];
    $username = $row['username'];
    $imagen = $row['imagen'];
}

include '../idiomas/idiomas.php';

if (isset($_POST['Generar_tabla'])) {
    $horarioPersonalizado = $_POST['horario'];
    $tareas = $_POST['tareas'];
    $importancias = $_POST['importancias'];
    $fechas = $_POST['fechas'];

    // Crear una matriz para almacenar las tareas por día y hora
    $calendario = array(
        'Monday' => array(),
        'Tuesday' => array(),
        'Wednesday' => array(),
        'Thursday' => array(),
        'Friday' => array()
    );
}
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
    <form method="post" action="ver_tabla.php">
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

        <button type="submit" name="submit">Generar horario</button>
    </form>

    <script>
        // Agregar nueva tarea al formulario
        let numTareas = 1;
        document.getElementById("agregar_tarea").addEventListener("click", function() {
            numTareas++;

            let divTarea = document.createElement("div");
            divTarea.className = "tarea";
            divTarea.innerHTML = `
                <label for="tarea${numTareas}">Tarea:</label>
                <input type="text" name="tareas[]" id="tarea${numTareas}" required>
                <label for="importancia${numTareas}">Importancia:</label>
                <input type="number" name="importancias[]" id="importancia${numTareas}" min="1" max="10" required>
                <label for="fecha${numTareas}">Fecha:</label>
                <input type="date" name="fechas[]" id="fecha${numTareas}" required>
            `;

            document.getElementById("tareas").appendChild(divTarea);
        });
    </script>
</body>
</html>
