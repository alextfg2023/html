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
                        // Obtener el mes y año actual
                        $mes_actual = date('m');
                        $año_actual = date('Y');

                        // Obtener el nombre del mes actual en español
                        $nombres_meses = array(
                            '01' => $palabras['home']['1'],
                            '02' => $palabras['home']['2'],
                            '03' => $palabras['home']['3'],
                            '04' => $palabras['home']['4'],
                            '05' => $palabras['home']['5'],
                            '06' => $palabras['home']['6'],
                            '07' => $palabras['home']['7'],
                            '08' => $palabras['home']['8'],
                            '09' => $palabras['home']['9'],
                            '10' => $palabras['home']['10'],
                            '11' => $palabras['home']['11'],
                            '12' => $palabras['home']['12']
                        );

                        $nombre_mes_actual = $nombres_meses[$mes_actual];

                        // Calendario escolar
                        $totalFechasE = count($calendario_diaE);
                        echo "<h2>".$palabras['home']['calendario_escolar']." ".$nombre_mes_actual." ".$año_actual."</h2><br>";
                        echo "<h3>".$palabras['home']['explicacion_escolar']."</h3>";

                        // El resto del código sigue igual...


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

                        // Obtener el número de días en el mes actual
                        $numero_dias_mes_actual = date('t');

                        // Obtener el día de la semana del primer día del mes actual
                        $primer_dia_semana = date('N', strtotime("$año_actual-$mes_actual-01"));

                        // Calcular el número de días en la fila inicial antes del primer día del mes
                        $numDiasPrevios = $primer_dia_semana - 1;

                        // Mostrar celdas vacías para los días previos al primer día del mes
                        for ($i = 0; $i < $numDiasPrevios; $i++) {
                            echo '<td></td>';
                            $filaActualE++;

                            // Si alcanza el final de la fila, cerrar la fila
                            if ($filaActualE % $numColumnasE === 0) {
                                echo '</tr>';
                            }
                        }

                        // Iterar sobre cada día del mes actual
                        for ($dia = 1; $dia <= $numero_dias_mes_actual; $dia++) {
                            // Obtener la fecha en formato 'Y-m-d' para cada día del mes actual
                            $fecha_actual = date('Y-m-d', strtotime("$año_actual-$mes_actual-$dia"));

                            // Obtener el tipo de día escolar
                            $tipo_dia_escolar = "";
                            if (isset($calendario_diaE[$fecha_actual])) {
                                foreach ($calendario_diaE[$fecha_actual] as $dia_escolar) {
                                    $tipo_dia_escolar = $dia_escolar['tipo'];
                                }
                            }

                            // Si es una nueva fila, abrir una nueva fila en la tabla
                            if ($filaActualE % $numColumnasE === 0) {
                                echo '<tr>';
                            }

                            // Mostrar el día en la celda correspondiente
                            echo '<td>' . $dia . '<br>' . $tipo_dia_escolar . '</td>';
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
                        // Obtener el mes y año actual
                        $mes_actual = date('m');
                        $año_actual = date('Y');

                        // Obtener el nombre del mes actual en español
                        $nombres_meses = array(
                            '01' => $palabras['home']['1'],
                            '02' => $palabras['home']['2'],
                            '03' => $palabras['home']['3'],
                            '04' => $palabras['home']['4'],
                            '05' => $palabras['home']['5'],
                            '06' => $palabras['home']['6'],
                            '07' => $palabras['home']['7'],
                            '08' => $palabras['home']['8'],
                            '09' => $palabras['home']['9'],
                            '10' => $palabras['home']['10'],
                            '11' => $palabras['home']['11'],
                            '12' => $palabras['home']['12']
                        );
                        
                        $nombre_mes_actual = $nombres_meses[$mes_actual];

                        // Obtener el día de la semana del primer día del mes actual
                        $primer_dia_semana = date('N', strtotime("$año_actual-$mes_actual-01"));

                        // Calendario laboral
                        $totalFechasT = count($calendario_diaT);
                        echo "<h2>".$palabras['home']['calendario_laboral']." ".$nombre_mes_actual." ".$año_actual."</h2><br>";
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

                        // Calcular el número de días en la fila inicial antes del primer día del mes
                        $numDiasPrevios = $primer_dia_semana - 1;

                        // Mostrar celdas vacías para los días previos al primer día del mes
                        for ($i = 0; $i < $numDiasPrevios; $i++) {
                            echo '<td></td>';
                            $filaActualT++;

                            // Si alcanza el final de la fila, cerrar la fila
                            if ($filaActualT % $numColumnasT === 0) {
                                echo '</tr>';
                            }
                        }

                        // Iterar sobre cada día del mes actual
                        for ($dia = 1; $dia <= $numero_dias_mes_actual; $dia++) {
                            // Obtener la fecha en formato 'Y-m-d' para cada día del mes actual
                            $fecha_actual = date('Y-m-d', strtotime("$año_actual-$mes_actual-$dia"));

                            // Obtener el tipo de día laboral
                            $tipo_dia_laboral = "";
                            if (isset($calendario_diaT[$fecha_actual])) {
                                foreach ($calendario_diaT[$fecha_actual] as $dia_laboral) {
                                    $tipo_dia_laboral = $dia_laboral['tipo'];
                                }
                            }

                            // Si es una nueva fila, abrir una nueva fila en la tabla
                            if ($filaActualT % $numColumnasT === 0) {
                                echo '<tr>';
                            }

                            // Mostrar el día en la celda correspondiente
                            echo '<td>' . $dia . '<br>' . $tipo_dia_laboral . '</td>';
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
                        // Obtener el mes y año actual
                        $mes_actual = date('m');
                        $año_actual = date('Y');

                        // Obtener el nombre del mes actual en español
                        $nombres_meses = array(
                            '01' => $palabras['home']['1'],
                            '02' => $palabras['home']['2'],
                            '03' => $palabras['home']['3'],
                            '04' => $palabras['home']['4'],
                            '05' => $palabras['home']['5'],
                            '06' => $palabras['home']['6'],
                            '07' => $palabras['home']['7'],
                            '08' => $palabras['home']['8'],
                            '09' => $palabras['home']['9'],
                            '10' => $palabras['home']['10'],
                            '11' => $palabras['home']['11'],
                            '12' => $palabras['home']['12']
                        );
                        
                        $nombre_mes_actual = $nombres_meses[$mes_actual];

                        // Obtener el día de la semana del primer día del mes actual
                        $primer_dia_semana = date('N', strtotime("$año_actual-$mes_actual-01"));

                        // Calendario laboral
                        $totalFechasT = count($calendario_diaT);
                        echo "<h2>".$palabras['home']['calendario_laboral']." ".$nombre_mes_actual." ".$año_actual."</h2><br>";
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

                        // Calcular el número de días en la fila inicial antes del primer día del mes
                        $numDiasPrevios = $primer_dia_semana - 1;

                        // Mostrar celdas vacías para los días previos al primer día del mes
                        for ($i = 0; $i < $numDiasPrevios; $i++) {
                            echo '<td></td>';
                            $filaActualT++;

                            // Si alcanza el final de la fila, cerrar la fila
                            if ($filaActualT % $numColumnasT === 0) {
                                echo '</tr>';
                            }
                        }

                        // Iterar sobre cada día del mes actual
                        for ($dia = 1; $dia <= $numero_dias_mes_actual; $dia++) {
                            // Obtener la fecha en formato 'Y-m-d' para cada día del mes actual
                            $fecha_actual = date('Y-m-d', strtotime("$año_actual-$mes_actual-$dia"));

                            // Obtener el tipo de día laboral
                            $tipo_dia_laboral = "";
                            if (isset($calendario_diaT[$fecha_actual])) {
                                foreach ($calendario_diaT[$fecha_actual] as $dia_laboral) {
                                    $tipo_dia_laboral = $dia_laboral['tipo'];
                                }
                            }

                            // Si es una nueva fila, abrir una nueva fila en la tabla
                            if ($filaActualT % $numColumnasT === 0) {
                                echo '<tr>';
                            }

                            // Mostrar el día en la celda correspondiente
                            echo '<td>' . $dia . '<br>' . $tipo_dia_laboral . '</td>';
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
                        // Obtener el mes y año actual
                        $mes_actual = date('m');
                        $año_actual = date('Y');

                        // Obtener el nombre del mes actual en español
                        $nombres_meses = array(
                            '01' => $palabras['home']['1'],
                            '02' => $palabras['home']['2'],
                            '03' => $palabras['home']['3'],
                            '04' => $palabras['home']['4'],
                            '05' => $palabras['home']['5'],
                            '06' => $palabras['home']['6'],
                            '07' => $palabras['home']['7'],
                            '08' => $palabras['home']['8'],
                            '09' => $palabras['home']['9'],
                            '10' => $palabras['home']['10'],
                            '11' => $palabras['home']['11'],
                            '12' => $palabras['home']['12']
                        );
                        
                        $nombre_mes_actual = $nombres_meses[$mes_actual];

                        // Calendario escolar
                        $totalFechasE = count($calendario_diaE);
                        echo "<h2>".$palabras['home']['calendario_escolar']." ".$nombre_mes_actual." ".$año_actual."</h2><br>";
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

                        // Obtener el número de días en el mes actual
                        $numero_dias_mes_actual = date('t');

                        // Obtener el día de la semana del primer día del mes actual
                        $primer_dia_semana = date('N', strtotime("$año_actual-$mes_actual-01"));

                        // Calcular el número de días en la fila inicial antes del primer día del mes
                        $numDiasPrevios = $primer_dia_semana - 1;

                        // Mostrar celdas vacías para los días previos al primer día del mes
                        for ($i = 0; $i < $numDiasPrevios; $i++) {
                            echo '<td></td>';
                            $filaActualE++;

                            // Si alcanza el final de la fila, cerrar la fila
                            if ($filaActualE % $numColumnasE === 0) {
                                echo '</tr>';
                            }
                        }

                        // Iterar sobre cada día del mes actual
                        for ($dia = 1; $dia <= $numero_dias_mes_actual; $dia++) {
                            // Obtener la fecha en formato 'Y-m-d' para cada día del mes actual
                            $fecha_actual = date('Y-m-d', strtotime("$año_actual-$mes_actual-$dia"));

                            // Obtener el tipo de día escolar
                            $tipo_dia_escolar = "";
                            if (isset($calendario_diaE[$fecha_actual])) {
                                foreach ($calendario_diaE[$fecha_actual] as $dia_escolar) {
                                    $tipo_dia_escolar = $dia_escolar['tipo'];
                                }
                            }

                            // Si es una nueva fila, abrir una nueva fila en la tabla
                            if ($filaActualE % $numColumnasE === 0) {
                                echo '<tr>';
                            }

                            // Mostrar el día en la celda correspondiente
                            echo '<td>' . $dia . '<br>' . $tipo_dia_escolar . '</td>';
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