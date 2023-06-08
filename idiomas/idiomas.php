<?php
if(isset($_POST['lang'])){
        $_SESSION['lang'] = $_POST['lang'];
        $idioma = $_SESSION['lang'];
    } else if(isset($_SESSION['lang'])) {
        $idioma = $_SESSION['lang'];
    } else {
        $idioma = 'es';
    }

    $archivo = file_exists("../idiomas/$idioma.json") ? 
                            "../idiomas/$idioma.json" : 
                            "../idiomas/es.json";

    $contenido = file_get_contents($archivo);
    $palabras = json_decode($contenido, true);
?>