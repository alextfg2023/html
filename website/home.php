<?php

include '../complementosPHP/bbdd.php';
session_start();

if (!isset($_SESSION['SESSION_EMAIL'])) {
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

if (mysqli_num_rows($calendario_trabajo) > 0) {
    while ($row = mysqli_fetch_assoc($calendario_trabajo)) {
        $fechaT = $row['fecha'];
        $tipoT = $row['tipo'];
        $dia_semanaT = $row['dia_semana'];
        $calendario_diaT[$fechaT][] = array('tipo' => $tipoT, 'dia_semana' => $dia_semanaT);
    }
}

$calendario_escolar = mysqli_query($conn, "SELECT * FROM calendario_escolar");
$calendario_diaE = array();

if (mysqli_num_rows($calendario_escolar) > 0) {
    while ($row = mysqli_fetch_assoc($calendario_escolar)) {
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
    <link rel="stylesheet" href="../assets/css/homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome5.12.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title><?php echo $palabras['config']['home_title'] ?></title>
</head>
<body>
    <div class="wrapper">
        <div class="top_navbar">
            <div class="hamburger">
                <div class="hamburger_inner">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
            </div>
            <div class="menu">
                <div class="logo">
                    <h2><?php echo $palabras['config']['index_title'] ?></h2>
                </div>
                <div class="right_menu">
                    <ul>
                        <li>
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>" alt="profile.pic" class="fas">
                            <div class="profile_dd">
                                <div class="dd_item">
                                    <a href="overview.php?id=<?php echo $id; ?>"><?php echo $palabras['home']['perfil']; ?></a>
                                </div>
                                <div class="dd_item">
                                    <a href="../complementosPHP/logout.php"><?php echo $palabras['config']['cerrar_sesion']; ?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main_container">
            <div class="sidebar">
                <div class="sidebar_inner">
                    <div class="profile">
                        <div class="img">
                            <img src="<?php echo isset($imagen) ? $imagen : ''; ?>" alt="profile_pic">
                        </div>
                        <div class="profile_info">
                            <?php
                                if($sexo == 'hombre'){
                            ?>
                                <p><?php echo $palabras['general']['bienvenido']; ?></p>
                            <?php
                                }elseif($sexo == 'mujer'){
                            ?>
                                <p><?php echo $palabras['general']['bienvenida']; ?></p>
                            <?php
                                }elseif($sexo == 'otros'){
                            ?>
                                <p><?php echo $palabras['general']['bienvenid@']; ?></p>
                            <?php
                                }
                            ?>
                            <p class="profile_name"><?php echo $username;?></p>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <a href="home.php?id=<?php echo $id;?>" class="active">
                                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                                <?php
                                    if($tipo == 'ambos'){
                                ?>
                                    <span class="title"><?php echo $palabras['home']['calendarios']; ?></span>
                                <?php
                                    }else{
                                ?>
                                    <span class="title"><?php echo $palabras['home']['calendario']; ?></span>
                                <?php
                                    }
                                ?>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="../create.sche/create.sche.php?id=<?php echo $id;?>">
                                <span class="icon"><i class="fas fa-calendar-plus"></i></span>
                                <span class="title"><?php echo $palabras['home']['tablas_c']; ?></span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="../create.sche/view.sche.php">
                                <span class="icon"><i class="fas fa-calendar-check"></i></span>
                                <span class="title"><?php echo $palabras['home']['tablas_v']; ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="idiomas">
                    <?php
                        include '../idiomas/lista_idiomas.php';
                    ?>
                    </div>
                </div>

            </div>
            <div class="container">
            <?php
                $año_actual = date("Y");
                if ($tipo == 'ambos') {
            ?>
                <div class="item">
            <?php
                // Calendario escolar
                $totalFechasE = count($calendario_diaE);
                echo "<h2>".$palabras['home']['calendario_escolar']."".$año_actual."</h2><br>";
                echo "<h3>".$palabras['home']['explicacion_escolar']."</h3>";

                $diasSemanaE = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

                echo '<table>';

                $numColumnasE = count($diasSemanaE);
                $filaActualE = 0;

                // Mostrar encabezado de columnas
                echo '<tr>';
                foreach ($diasSemanaE as $diaE) {
                  echo '<th class="grande">' . $diaE . '</th>';
                }
                echo '</tr>';
                
                $diasSemanaEP = array($palabras['home']['L'], $palabras['home']['M'], $palabras['home']['X'], $palabras['home']['J'], $palabras['home']['V'], $palabras['home']['S'], $palabras['home']['D']);

                echo '<tr>';
                foreach ($diasSemanaEP as $diaEP) {
                  echo '<th class="pequeño">' . $diaEP . '</th>';
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
                    $diaE = date('d', strtotime($fechaE));
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

                echo '</table>';
            ?>
                </div>
                <div class="item">
            <?php
                // Calendario laboral
                $totalFechasT = count($calendario_diaT);
                echo "<h2>".$palabras['home']['calendario_laboral']."".$año_actual."</h2><br>";
                echo "<h3>".$palabras['home']['explicacion_laboral']."</h3>";

                $diasSemanaT = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

                echo '<table>';

                $numColumnasT = count($diasSemanaT);
                $filaActualT = 0;

                // Mostrar encabezado de columnas
                echo '<tr>';
                foreach ($diasSemanaT as $diaT) {
                    echo '<th class="grande">' . $diaT . '</th>';
                }
                echo '</tr>';

                $diasSemanaTP = array($palabras['home']['L'], $palabras['home']['M'], $palabras['home']['X'], $palabras['home']['J'], $palabras['home']['V'], $palabras['home']['S'], $palabras['home']['D']);

                echo '<tr>';
                foreach ($diasSemanaTP as $diaTP) {
                  echo '<th class="pequeño">' . $diaTP . '</th>';
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
                    $diaT = date('d', strtotime($fechaT));;
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

                echo '</table>';
            ?>
                </div>
            <?php
                }elseif ($tipo == 'trabajador') {
            ?>
                <div class="item">
            <?php
                $totalFechasT = count($calendario_diaT);
                echo "<h2>".$palabras['home']['calendario_laboral']."".$año_actual."</h2><br>";
                echo "<h3>".$palabras['home']['explicacion_laboral']."</h3>";
            
                $diasSemanaT = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);
            
                echo '<table>';
            
                $numColumnasT = count($diasSemanaT);
                $filaActualT = 0;
            
                // Mostrar encabezado de columnas
                echo '<tr>';
                foreach ($diasSemanaT as $diaT) {
                    echo '<th class="grande">' . $diaT . '</th>';
                }
                echo '</tr>';

                $diasSemanaTP = array($palabras['home']['L'], $palabras['home']['M'], $palabras['home']['X'], $palabras['home']['J'], $palabras['home']['V'], $palabras['home']['S'], $palabras['home']['D']);

                echo '<tr>';
                foreach ($diasSemanaTP as $diaTP) {
                  echo '<th class="pequeño">' . $diaTP . '</th>';
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
                    $diaT = date('d', strtotime($fechaT));
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
            
                echo '</table>';
            ?>
                </div>
            <?php     
                }elseif ($tipo == 'estudiante') {
            ?>
                <div class="item">
            <?php
                $totalFechasE = count($calendario_diaE);
                echo "<h2>".$palabras['home']['calendario_escolar']."".$año_actual."</h2><br>";
                echo "<h3>".$palabras['home']['explicacion_escolar']."</h3>";

                $diasSemanaE = array($palabras['home']['lunes'], $palabras['home']['martes'], $palabras['home']['miercoles'], $palabras['home']['jueves'], $palabras['home']['viernes'], $palabras['home']['sabado'], $palabras['home']['domingo']);

                echo '<table>';

                $numColumnasE = count($diasSemanaE);
                $filaActualE = 0;

                // Mostrar encabezado de columnas
                echo '<tr>';
                foreach ($diasSemanaE as $diaE) {
                    echo '<th class="grande">' . $diaE . '</th>';
                }
                echo '</tr>';

                $diasSemanaEP = array($palabras['home']['L'], $palabras['home']['M'], $palabras['home']['X'], $palabras['home']['J'], $palabras['home']['V'], $palabras['home']['S'], $palabras['home']['D']);

                echo '<tr>';
                foreach ($diasSemanaEP as $diaEP) {
                  echo '<th class="pequeño">' . $diaEP . '</th>';
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
                    $diaE = date('d', strtotime($fechaE));
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

                echo '</table>';
            ?>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // Verifica si la pantalla es lo suficientemente grande para ejecutar el script
            if (window.matchMedia("(min-width: 584px)").matches) {
                // Código a ejecutar solo en pantallas grandes
                $(".hamburger").click(function(){
                    $(".wrapper").toggleClass("active");
                });
            }
            $(".right_menu li .fas").click(function(){
                    $(".profile_dd").toggleClass("active");
                });
        });
    </script>
</body>
</html>