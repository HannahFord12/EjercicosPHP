<?php
    //header('Location: login.php');

    $entrar=$_GET['entrar'] ?? "1";

    if($entrar=="0"){
        header('Location: login.php');
        exit;
    }elseif($entrar=="1"){
        echo "Bienvenido a la pagina";
    }
?>