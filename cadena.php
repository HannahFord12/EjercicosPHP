<?php
    $nombre= $_GET['nombre'] ?? 'Hannah';

    echo $nombre; 
?>
<br>
<?php    
    echo trim($nombre,'/');
?>
<br>
<?php
    echo strlen($nombre);
?>
<br>
<?php
    echo strtoupper($nombre);
    
?>
<br>
<?php
    echo strtolower($nombre);
?>
<br>
<?php
    $prefijo=$_GET['prefijo'];
    if(strpos($nombre, $prefijo)=== false){
        echo 'No está';
    }else{
        echo 'Está';
    }
    //echo strpos($nombre, $prefijo); //si pone 0 es que si está
?>
<br>
<?php
    $letr='a';
    echo substr_count(strtolower($nombre), $letr);

?>
<br>
<?php
    if (stripos($nombre, $letr) === false){
        echo 'No hay letra a';
    }else{
        echo stripos($nombre, $letr);
    }
?>
<br>
<?php
    $lt='o';
    $cero='0';
    echo str_ireplace($lt,$cero,strtolower($nombre));
?>
<br>
<?php
    $url='http://username:password@hostname:9090/path?arg=value#anchor';
    echo parse_url($url, PHP_URL_SCHEME);
?>
<br>
<?php
    echo parse_url($url, PHP_URL_USER);
?>
<br>
<?php
    echo parse_url($url, PHP_URL_HOST);
?>
<br>
<?php
    echo parse_url($url, PHP_URL_QUERY);
?>

