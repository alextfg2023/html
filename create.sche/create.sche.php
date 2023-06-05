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
    <link rel="stylesheet" href="../assets/css/create_sches.css">
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
                                    <a href="../website/overview.php?id=<?php echo $id; ?>"><?php echo $palabras['home']['perfil']; ?></a>
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
                            <a href="../website/home.php?id=<?php echo $id; ?>">
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
                            <a href="create.sche.php?id=<?php echo $id; ?>" class="active">
                                <span class="icon"><i class="fas fa-calendar-plus"></i></span>
                                <span class="title"><?php echo $palabras['home']['tablas_c']; ?></span>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="view.sche.php">
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
                <div class="item">
                    <?php
                        if($tipo == 'ambos'){
                            echo "<h1>".$palabras['crear_tablas']['titutloA']."</h1><br>";
                        }if($tipo == 'estudiante'){
                            echo "<h1>".$palabras['crear_tablas']['titutloE']."</h1><br>";
                        }if($tipo == 'trabajador'){
                            echo "<h1>".$palabras['crear_tablas']['titutloT']."</h1><br>";
                        }
                    ?>
                    <form method="post" action="../create.sche/preview.sche.php">
                        <label for="horario"><?php echo $palabras['crear_tablas']['horario']?></label>
                        <div class="input-box">
                            <input type="text" name="horario" id="horario" placeholder="<?php echo $palabras['crear_tablas']['ejemplo_horario']?>" required><br><br>
                        </div>

                        <div id="tareas">
                            <div class="tarea">
                                <label for="tarea1"><?php echo $palabras['crear_tablas']['tareas'] ?></label>
                                <div class="input-box">
                                    <input class="input-box" type="text" name="tareas[]" id="tarea1" placeholder="<?php echo $palabras['crear_tablas']['ejemplo_tarea']?>" required><br><br>
                                </div>
                                <label for="importancia1"><?php echo $palabras['crear_tablas']['importancia']?></label>
                                <div class="input-box">
                                    <input class="input-box" type="number" name="importancias[]" id="importancia1" min="1" max="10" placeholder="<?php echo $palabras['crear_tablas']['ejemplo_imp']?>" required><br><br>
                                </div>
                                <label for="fecha1"> <?php echo $palabras['crear_tablas']['fecha']?></label>
                                <div class="input-box">
                                    <input class="input-box" type="date" name="fechas[]" id="fecha1" required><br><br>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <div class="button">
                            <input type="button" id="agregar_tarea" value="<?php echo $palabras['crear_tablas']['agregar_tarea']?>"/><br><br>
                        </div>
                        <div class="button">
                            <input type="button" name="Generar_tabla" value="<?php echo $palabras['crear_tablas']['generar_horario']?>"/>
                        </div>
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

                            // Nuevo div con la clase "input-box"
                            let divInputBox = document.createElement("div");
                            divInputBox.className = "input-box";

                            let inputTarea = document.createElement("input");
                            inputTarea.type = "text";
                            inputTarea.name = "tareas[]";
                            inputTarea.id = "tarea" + numTareas;
                            inputTarea.required = true;

                            // Añadir el input dentro del div "input-box"
                            divInputBox.appendChild(inputTarea);
                            divInputBox.appendChild(document.createElement("br")); // Añade un salto de línea

                            // Añadir el label y el div "input-box" al div de la tarea
                            divTarea.appendChild(labelTarea);
                            divTarea.appendChild(divInputBox);

                            let labelImportancia = document.createElement("label");
                            labelImportancia.textContent = " <?php echo $palabras['crear_tablas']['importancia']?> ";
                            let inputImportancia = document.createElement("input");
                            inputImportancia.type = "number";
                            inputImportancia.name = "importancias[]";
                            inputImportancia.id = "importancia" + numTareas;
                            inputImportancia.min = "1";
                            inputImportancia.max = "10";
                            inputImportancia.required = true;

                            // Nuevo div con la clase "input-box"
                            divInputBox.appendChild(document.createElement("br"));
                            divInputBox = document.createElement("div");
                            divInputBox.className = "input-box";

                            // Añadir el input dentro del div "input-box"
                            divInputBox.appendChild(inputImportancia);
                            divInputBox.appendChild(document.createElement("br")); // Añade un salto de línea

                            // Añadir el label y el div "input-box" al div de la tarea
                            divTarea.appendChild(labelImportancia);
                            divTarea.appendChild(divInputBox);

                            let labelFecha = document.createElement("label");
                            labelFecha.textContent = " <?php echo $palabras['crear_tablas']['fecha']?> ";
                            let inputFecha = document.createElement("input");
                            inputFecha.type = "date";
                            inputFecha.name = "fechas[]";
                            inputFecha.id = "fecha" + numTareas;
                            inputFecha.required = true;

                            // Nuevo div con la clase "input-box"
                            divInputBox.appendChild(document.createElement("br"));
                            divInputBox = document.createElement("div");
                            divInputBox.className = "input-box";

                            // Añadir el input dentro del div "input-box"
                            divInputBox.appendChild(inputFecha);
                            divInputBox.appendChild(document.createElement("br")); // Añade un salto de línea

                            // Añadir el label y el div "input-box" al div de la tarea
                            divTarea.appendChild(labelFecha);
                            divTarea.appendChild(divInputBox);
                            divInputBox.appendChild(document.createElement("br"));

                            document.getElementById("tareas").appendChild(divTarea);
                        });
                    </script>           
                </div>
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