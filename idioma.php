
<?php
    $language="";
    $language = $_GET['setLanguage'] ?? $_COOKIE['language'] ?? "es";

    setcookie("idioma",$language, time()+ 30*24*60*60);

    if ($language == "en"){
        $content = "This page is in English";
        $title = "Change the language of the page";
    }else{
        $content = "Esta página está en Castellano (Idioma por defecto)";
        $title = "Cambiar el idioma de la página";
    }
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?= $title ?></title>
<meta name="author" content="Víctor Ponz">
</head>    
<body>
<ul><?= $title ?>
    <li><a href='idioma.php?setLanguage=es'>Español</a></li>
    <li><a href='idioma.php?setLanguage=en'>Inglés</a></li>
</ul>
<?= $content ?>
</body>
</html>
