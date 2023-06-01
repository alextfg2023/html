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

$calendario_trabajo = mysqli_query($conn, "SELECT * FROM calendario_laboral");
$calendario_diaT = array();

if (mysqli_num_rows($calendario_trabajo) > 0){
    while ($row = mysqli_fetch_assoc($calendario_trabajo)){
        $fechaT = $row['fecha'];
        $tipoT = $row['tipo'];
        $dia_semanaT = $row['dia_semana'];
        $calendario_diaT[$fechaT][] = array('tipo' => $tipoT, 'dia_semana' => $dia_semanaT);
    }
}

$calendario_escolar = mysqli_query($conn, "SELECT * FROM calendario_escolar");
$calendario_diaE = array();

if (mysqli_num_rows($calendario_escolar) > 0){
    while ($row = mysqli_fetch_assoc($calendario_escolar)){
        $fechaE = $row['fecha'];
        $tipoE = $row['tipo'];
        $dia_semanaE = $row['dia_semana'];
        $calendario_diaE[$fechaE][] = array('tipo' => $tipoE, 'dia_semana' => $dia_semanaE);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $palabras['config']['home_title']?></title>
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
    <br>
    <?php 
    if($sexo == 'hombre'){
        echo "<p>".$palabras['home']['bienvenido'].' '.$username.' '."<img src= '$imagen' width='40'></p>";
    } elseif($sexo == 'mujer'){
        echo "<p>".$palabras['home']['bienvenida'].' '.$username."</p>";
    } 
    ?>
    <br>
    <a href="overview.php?id=<?php echo $id; ?>"><?php echo $palabras['home']['perfil']?></a>
    <br>
    <br>
    <a href="../create.tables/create.table.php" class=""><?php echo $palabras['home']['tablas_c']?></a>
    <br>
    <br>
    <a href="../create.tables/ver_tabla.php" class=""><?php echo $palabras['home']['tablas_v']?></a>
    <br>
    <br>
    <?php
        if ($tipo == 'ambos') {
            // Calendario escolar
            $totalFechasE = count($calendario_diaE);
            echo "<h3>Total de fechas en el calendario escolar: " . $totalFechasE . "</h3>";

            $diasSemanaE = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

            echo '<table>';

            $numColumnasE = count($diasSemanaE);
            $filaActualE = 0;

            // Mostrar encabezado de columnas
            echo '<tr>';
            foreach ($diasSemanaE as $diaE) {
                echo '<th>' . $diaE . '</th>';
            }
            echo '</tr>';

            // Obtener el índice del día de la semana para ubicar correctamente la fecha de la primera fila
            $primerFechaE = array_key_first($calendario_diaE);
            $dia_semana_primer_fechaE = date('N', strtotime($primerFechaE));
            $columna_vaciaE = true;

            // Rellenar las columnas vacías antes del primer día de la semana
            while ($dia_semana_primer_fechaE > 1) {
                echo '<td></td>';
                $dia_semana_primer_fechaE--;
                $filaActualE++;
            }

            foreach ($calendario_diaE as $fechaE => $datosE) {
                // Si es una nueva fila, abrir una nueva fila en la tabla
                if ($filaActualE % $numColumnasE === 0) {
                    echo '<tr>';
                }

                // Mostrar el día en la celda correspondiente
                $diaE = $fechaE;
                echo '<td>' . $diaE . '<br>';

                // Recorrer los datos del día y mostrar el tipo
                foreach ($datosE as $datoE) {
                    echo $datoE['tipo'] . '<br>';
                }

                echo '</td>';
                $filaActualE++;

                // Si alcanza el final de la fila, cerrar la fila
                if ($filaActualE % $numColumnasE === 0) {
                    echo '</tr>';
                }
            }

            // Si no se cerró la última fila, cerrarla ahora
            if ($filaActualE % $numColumnasE !== 0) {
                echo '</tr>';
            }

            echo '</table><br><br>';

            // Calendario laboral
            $totalFechasT = count($calendario_diaT);
            echo "<h3>Total de fechas en el calendario laboral: " . $totalFechasT . "</h3>";

            $diasSemanaT = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

            echo '<table>';

            $numColumnasT = count($diasSemanaT);
            $filaActualT = 0;

            // Mostrar encabezado de columnas
            echo '<tr>';
            foreach ($diasSemanaT as $diaT) {
                echo '<th>' . $diaT . '</th>';
            }
            echo '</tr>';

            // Obtener el índice del día de la semana para ubicar correctamente la fecha de la primera fila
            $primerFechaT = array_key_first($calendario_diaT);
            $dia_semana_primer_fechaT = date('N', strtotime($primerFechaT));
            $columna_vaciaT = true;

            // Rellenar las columnas vacías antes del primer día de la semana
            while ($dia_semana_primer_fechaT > 1) {
                echo '<td></td>';
                $dia_semana_primer_fechaT--;
                $filaActualT++;
            }

            foreach ($calendario_diaT as $fechaT => $datosT) {
                // Si es una nueva fila, abrir una nueva fila en la tabla
                if ($filaActualT % $numColumnasT === 0) {
                    echo '<tr>';
                }

                // Mostrar el día en la celda correspondiente
                $diaT = $fechaT;
                echo '<td>' . $diaT . '<br>';

                // Recorrer los datos del día y mostrar el tipo
                foreach ($datosT as $datoT) {
                    echo $datoT['tipo'] . '<br>';
                }

                echo '</td>';
                $filaActualT++;

                // Si alcanza el final de la fila, cerrar la fila
                if ($filaActualT % $numColumnasT === 0) {
                    echo '</tr>';
                }
            }

            // Si no se cerró la última fila, cerrarla ahora
            if ($filaActualT % $numColumnasT !== 0) {
                echo '</tr>';
            }

            echo '</table><br><br>';
            
        } elseif ($tipo == 'trabajador') {

            $totalFechasT = count($calendario_diaT);
            echo "<h3>Total de fechas en el calendario laboral: " . $totalFechasT . "</h3>";

            $diasSemanaT = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

            echo '<table>';

            $numColumnasT = count($diasSemanaT);
            $filaActualT = 0;

            // Mostrar encabezado de columnas
            echo '<tr>';
            foreach ($diasSemanaT as $diaT) {
                echo '<th>' . $diaT . '</th>';
            }
            echo '</tr>';

            // Obtener el índice del día de la semana para ubicar correctamente la fecha de la primera fila
            $primerFechaT = array_key_first($calendario_diaT);
            $dia_semana_primer_fechaT = date('N', strtotime($primerFechaT));
            $columna_vaciaT = true;

            // Rellenar las columnas vacías antes del primer día de la semana
            while ($dia_semana_primer_fechaT > 1) {
                echo '<td></td>';
                $dia_semana_primer_fechaT--;
                $filaActualT++;
            }

            foreach ($calendario_diaT as $fechaT => $datosT) {
                // Si es una nueva fila, abrir una nueva fila en la tabla
                if ($filaActualT % $numColumnasT === 0) {
                    echo '<tr>';
                }

                // Mostrar el día en la celda correspondiente
                $diaT = $fechaT;
                echo '<td>' . $diaT . '<br>';

                // Recorrer los datos del día y mostrar el tipo
                foreach ($datosT as $datoT) {
                    echo $datoT['tipo'] . '<br>';
                }

                echo '</td>';
                $filaActualT++;

                // Si alcanza el final de la fila, cerrar la fila
                if ($filaActualT % $numColumnasT === 0) {
                    echo '</tr>';
                }
            }

            // Si no se cerró la última fila, cerrarla ahora
            if ($filaActualT % $numColumnasT !== 0) {
                echo '</tr>';
            }

            echo '</table><br><br>';
            
            } elseif ($tipo == 'estudiante') {

            $totalFechasE = count($calendario_diaE);
            echo "<h3>Total de fechas en el calendario escolar: " . $totalFechasE . "</h3>";

            $diasSemanaE = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

            echo '<table>';

            $numColumnasE = count($diasSemanaE);
            $filaActualE = 0;

            // Mostrar encabezado de columnas
            echo '<tr>';
            foreach ($diasSemanaE as $diaE) {
                echo '<th>' . $diaE . '</th>';
            }
            echo '</tr>';

            // Obtener el índice del día de la semana para ubicar correctamente la fecha de la primera fila
            $primerFechaE = array_key_first($calendario_diaE);
            $dia_semana_primer_fechaE = date('N', strtotime($primerFechaE));
            $columna_vaciaE = true;

            // Rellenar las columnas vacías antes del primer día de la semana
            while ($dia_semana_primer_fechaE > 1) {
                echo '<td></td>';
                $dia_semana_primer_fechaE--;
                $filaActualE++;
            }

            foreach ($calendario_diaE as $fechaE => $datosE) {
                // Si es una nueva fila, abrir una nueva fila en la tabla
                if ($filaActualE % $numColumnasE === 0) {
                    echo '<tr>';
                }

                // Mostrar el día en la celda correspondiente
                $diaE = $fechaE;
                echo '<td>' . $diaE . '<br>';

                // Recorrer los datos del día y mostrar el tipo
                foreach ($datosE as $datoE) {
                    echo $datoE['tipo'] . '<br>';
                }

                echo '</td>';
                $filaActualE++;

                // Si alcanza el final de la fila, cerrar la fila
                if ($filaActualE % $numColumnasE === 0) {
                    echo '</tr>';
                }
            }

            // Si no se cerró la última fila, cerrarla ahora
            if ($filaActualE % $numColumnasE !== 0) {
                echo '</tr>';
            }

            echo '</table><br><br>';
            
            }
        include '../idiomas/lista_idiomas.php';
    ?>
</body>
</html>
