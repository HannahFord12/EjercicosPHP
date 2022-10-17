<?php
    //cabecera solicitud 1
    $ser=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
    
    /*switch($ser){
        case 'en':
            echo 'This page is in English';
            break;
        case 'es':
            echo 'Esta pagina está en español';
            break;
        case 'fr':
            echo 'Cette page est en français';
            break;
        default:
            echo 'Idioma no predeterminado';
            break;

    }*/
    if($ser=='en'){
        echo 'This page is in English';
    }elseif($ser=='es'){
        echo 'Esta pagina está en español';
    }
?>