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
    <form method="post" action="../test_tablas/view.tables.php">
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