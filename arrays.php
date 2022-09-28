<?php
    $nombre =['Hannah', 'Mark','Carla','Marta'];
    echo count($nombre);
?>
<br>
<?php
    $cadena = implode(" ",$nombre);
    echo $cadena;
?>
<br>
<?php
    $n=$nombre;
    asort($nombre);
    echo implode(" ",$nombre);
    
?>
<br>
<?php
    $newarray= array_reverse($n, true);
    echo implode(" ",$newarray);
?>
<br>
<?php
    $clave=array_search("Hannah", $nombre);
    echo $clave;
?>
<br>
<?php
    $alumnos=[ ['id'=>"123m",'nombre'=>"Pepe",'edad'=>20],
     ['id'=>"222n",'nombre'=>"Juan",'edad'=>20], 
     ['id'=>"221l",'nombre'=>"Mari",'edad'=>20]];
    print("<table>");
    foreach($alumnos as $alumno){
        echo "<tr>";
        foreach($alumno as $valor){
            echo "<td>".$valor."</td>";
        }
        echo "</tr>";
    }
    print("</table>");
?>
<br>
<?php
    $arr=array_column($alumnos, 'nombre');
    print_r($arr);
?>
<br>
<?php
    $numeros=array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
    echo array_sum($numeros);
?>

<br>
<?php
    $colores= array('balnco', 'Verde', 'rojo');
    print_r('<ul>');
    foreach($colores as $color){
        echo '<li>'.$color.'</li>';
    }
    print_r('</ul>');
?>
<br>
<?php
    $colores= array('balnco'=>'blanco.html', 
    'verde'=>'verde.html', 
    'rojo'=>'rojo.html');
    print("<ul>");
    foreach($colores as $color=>$url){
        echo '<li>'.'<a href=$url>'.$color."</a>".'</li>';
    }
    print_r('</ul>');
?>
<br>
<?php
    $edad=array("Juan"=>"31","Maria"=>"41","Andres"=>"39","Berta"=>"40");

    ksort($edad);
    foreach($edad as $nombre=>$ed){
        echo "$nombre = $ed\n";
    }
    
?>
<br>
<?php

    asort($edad);
    foreach($edad as $nombre=>$ed){
        echo "$nombre = $ed\n";
    }
?>
<br>
<?php    
    krsort($edad);
    foreach($edad as $nombre=>$ed){
        echo "$nombre = $ed\n";
    }
    

?>
<br>
<?php
    arsort($edad);
    foreach($edad as $nombre=>$ed){
        echo "$nombre = $ed\n";
    }

?>
<br>
<?php
//soty2.php
    $mes="28,33,40,38,32,33,30,35,36,38,
    28,40,41,38,37,36,30,35,36,38,
    28,33,40,39,38";

    $temperatura  = explode(",", $mes);
    print_r($temperatura);
    $suma=0;
    foreach($temperatura as $valor){
        $suma=$suma+$valor;
    }
    $num=count($temperatura);
    $media=$suma/$num;
    echo $media;
        
    $aux=sort($temperatura);
    $algo=count($temperatura)-5;

    if($aux=='true'){
        for($i=0;$i<=5;$i++){
            print_r($temperatura[$i].",");
        }
        for($i=$num;$i>=$algo;$i--){
            print_r($temperatura[$i].","); //algo mal mirar
        }
    }
    

?>
<br>
<?php
//sort3.php
    function orden($a,$b){
        if(strlen($a)==strlen($b)){
            return 0;
        }
        return (strlen($a)<strlen($b))?-1:1;
    }

    $nombre=["Pepe"=>"es un hombre", "Maria"=>"Es", "Juan"=>"lo mismo"];

    uasort($nombre,'orden');
    print_r($nombre);
?>
<br>
<br>
<?php
//password.php
    function rand_Pass($upper = 1, $lower = 5, $numeric = 3, $other = 2){
        $pass=[];
        for ($i=0; $i <$upper ; $i++) { 
            $pass[]=chr(rand(65, 90));
        }
        for ($i=0; $i < $lower; $i++) { 
            $pass[]=strtolower(chr(rand(65, 90)));
        }
        for ($i=0; $i <$numeric; $i++) { 
            $pass[]=rand(1,9);
        }
        for ($i=0; $i <$other; $i++) { 
            $pass[]=chr(rand(33,37));
        }
        
        shuffle($pass);
        return implode($pass);
        
    }

    print_r(rand_Pass(2,3,1,4));
      
?>
<br>
<br>
<?php
//callback.php
    $ar=["Hola","H", "Hola que tal"];

    $map=array_map("strlen", $ar);
    print(min($map));
    print(max($map));
    
?>
<br>
<br>
<?php
//partlist
    $frase=["Seguro", "que", "apruebo", "esta", "asignatura"];

    print_r(implode(",",$frase));  //me imprime todo
  
    echo"<br>";
    $aux="";
    
    for ($i=1; $i < count($frase) ; $i++) { 
        $aux=$aux.$frase[$i-1]." ";
        echo "<br>".$aux."<br>";
        print_r(array_slice($frase,$i));
    }

    $arr1=[];
    print_r($arr1);

    /*foreach($frase as $elemento){
        $arr1=
    }*/
    
?>
<br>
<br>
<?php
    //filter.php
    $contactos = array(

        array("codigo" => 1, "nombre" => "Juan Pérez",

        "telefono" => "966112233", "email" => "juanp@gmail.com"),

        array("codigo" => 2, "nombre" => "Ana López",

        "telefono" => "965667788", "email" => "anita@hotmail.com"),

        array("codigo" => 3, "nombre" => "Mario Montero",

        "telefono" => "965929190", "email" => "mario.mont@gmail.com"),

        array("codigo" => 4, "nombre" => "Laura Martínez",

        "telefono" => "611223344", "email" => "lm2000@gmail.com"),

        array("codigo" => 5, "nombre" => "Nora Jover",

        "telefono" => "638765432", "email" => "norajover@hotmail.com"),

        );
    
    $filtrarPor = strtolower($_GET["filtrarPor"] ?? "@gmail.com");


    $filtrados = array_filter($contactos, 
        function($contactos) use ($filtrarPor){
            return strpos(strtolower($contactos["email"]), $filtrarPor) !== FALSE;
        });
    print_r($filtrados);
    

?>
