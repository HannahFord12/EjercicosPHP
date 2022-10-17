<?php
    //cabecera de respuesta 4
    header('Content-Type: application/zip');
    header('Content-Length: 100000');
    header('Content-Disposition: attachment; film="download.zip');

    for($i=0; $i<1000; $i++){
        echo str_repeat(".",1000);
        usleep(50000);
    }



?>