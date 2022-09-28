<?php

    $ser = $_SERVER['HTTP_USER_AGENT'];
    //echo $ser;
    
    $mots=strtolower($ser);
    //echo $mots;
    echo '<br>';
    if (strpos($mots,'firefox')!== false){ //si contiene la palabra firefox
        echo 'Bienvenido a la pagina';
    }else{
        echo 'Esto no es firefox';
    }

?>