<?php
// comprobamos si se ha enviado el formulario
if (isset($_POST['lang'])) {
  // establecemos una cookie con el idioma seleccionado
  setcookie('lang', $_POST['lang'], time() + (3600 * 24 * 30), '/');
  // redirigimos al usuario a la misma página
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

// cargamos el idioma seleccionado o el idioma predeterminado (español)
$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'es';

// aquí puedes cargar el archivo de idioma correspondiente según el valor de $lang
// por ejemplo, si $lang es "en", puedes cargar el archivo "lang-en.php"
// si no existe el archivo, puedes cargar un archivo predeterminado
// en este ejemplo, simplemente mostramos el valor de $lang
echo 'Idioma seleccionado: ' . $lang;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    <label for="lang">Selecciona el idioma:</label>
    <select name="lang" id="lang">
        <option value="en">Inglés</option>
        <option value="es">Español</option>
        <option value="fr">Francés</option>
    </select>
    <button type="submit">Cambiar idioma</button>
    </form>
</body>
</html>