<?php

include '../complementosPHP/bbdd.php';
session_start();

if(!isset($_SESSION['SESSION_EMAIL'])){
    header("Location: ../index.php");
}

include '../idiomas/idiomas.php'; 

$query = mysqli_query($conn, "SELECT * FROM usuarios WHERE email = '{$_SESSION['SESSION_EMAIL']}' OR username = '{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $nombre = $row['nombre'];
    $id = $row['id'];
    $sexo = $row['sexo'];
    $username = $row['username'];
    $imagen = $row['imagen'];
    $tipo = $row['tipo'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $palabras['config']['createtable_title']?></title>
    <style>
        .tarea {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
        if($tipo == 'ambos'){
            echo "<h1>".$palabras['crear_tablas']['titutloA']."</h1>";
        }if($tipo == 'estudiante'){
            echo "<h1>".$palabras['crear_tablas']['titutloE']."</h1>";
        }if($tipo == 'trabajador'){
            echo "<h1>".$palabras['crear_tablas']['titutloT']."</h1>";
        }
    ?>
    <form method="post" action="../create.tables/preview.tables.php">
        <label for="horario"><?php echo $palabras['crear_tablas']['horario']?></label>
        <input type="text" name="horario" id="horario" placeholder="<?php echo $palabras['crear_tablas']['ejemplo_horario']?>" required><br><br>

        <div id="tareas">
            <div class="tarea">
                <label for="tarea1"><?php echo $palabras['crear_tablas']['tareas']?></label>
                <input type="text" name="tareas[]" id="tarea1" placeholder="<?php echo $palabras['crear_tablas']['ejemplo_tarea']?>" required>
                <label for="importancia1"><?php echo $palabras['crear_tablas']['importancia']?></label>
                <input type="number" name="importancias[]" id="importancia1" min="1" max="10" placeholder="<?php echo $palabras['crear_tablas']['ejemplo_imp']?>" required>
                <label for="fecha1"> <?php echo $palabras['crear_tablas']['fecha']?></label>
                <input type="date" name="fechas[]" id="fecha1" required>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
        </div><br>

        <button type="button" id="agregar_tarea"><?php echo $palabras['crear_tablas']['agregar_tarea']?></button><br><br>

        <button type="submit" name="Generar_tabla"><?php echo $palabras['crear_tablas']['generar_horario']?></button><br><br>
    </form>

    <form method="post" action="../website/home.php">
        <button type="submit" name="Volver"><?php echo $palabras['crear_tablas']['volver']?></button>
    </form>
    <script>
        // Agregar nueva tarea al formulario
        let numTareas = 1;
        document.getElementById("agregar_tarea").addEventListener("click", function() {
            numTareas++;

            let divTarea = document.createElement("div");
            divTarea.className = "tarea";

            let labelTarea = document.createElement("label");
            labelTarea.textContent = "<?php echo $palabras['crear_tablas']['tareas']?> ";
            let inputTarea = document.createElement("input");
            inputTarea.type = "text";
            inputTarea.name = "tareas[]";
            inputTarea.id = "tarea" + numTareas;
            inputTarea.required = true;

            let labelImportancia = document.createElement("label");
            labelImportancia.textContent = " <?php echo $palabras['crear_tablas']['importancia']?> ";
            let inputImportancia = document.createElement("input");
            inputImportancia.type = "number";
            inputImportancia.name = "importancias[]";
            inputImportancia.id = "importancia" + numTareas;
            inputImportancia.min = "1";
            inputImportancia.max = "10";
            inputImportancia.required = true;

            let labelFecha = document.createElement("label");
            labelFecha.textContent = " <?php echo $palabras['crear_tablas']['fecha']?> ";
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
    <br>
    <?php
        include '../idiomas/lista_idiomas.php';
    ?>
</body>
</html>