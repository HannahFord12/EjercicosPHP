<?php
    //ejercicio header cabecera de respuesta 2
    
    header('Content_type: text/csv');
    header('Content-Disposition:attachment; filename="productos.csv"');

    $productos=array("1"=>"Prod1","2"=>"Prod2","3"=>"Prod3");

    foreach($productos as $id=>$element){
        echo $id.";".$element;
    }



?>