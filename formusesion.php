<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $opciones = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        );

        $pdo = new PDO(
            'mysql:host=localhost;dbname=usuario;charset=utf8',
            'root',
            'sa',
        $opciones);
        
            $username=$_POST['username'] ?? "";
            $email=$_POST['email'] ?? "";
            $password=$_POST['password'] ?? "";
            $confirm=$_POST['confirm']?? "";
            if($password != $confirm){
                echo "Password no coincide";
            }else{
                
                $sql="SELECT * from users where username='$username' and password='$password'";
                $existe= $pdo->query($sql)->fetch();
                if(!$existe){
                    $resultado= $pdo->exec("INSERT into users (username, email, password) values('$username', '$email', '$password')");
                    if($resultado === false )  {
                        echo 'No se ha introducido';
                    }else{
                        echo 'Se ha introducido';
                    }
                    if($password != $confirm){
                        echo "Password no coincide";
                    }
                }else{
                    echo "Ya existe";
                }

            }

            
        
        }
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
    
    <form action="formusesion.php" method="post" enctype="multipart/form-data">
        Nombre: <input type="texto" name="username"><br>
        Email: <input type="email" name="email"><br>
        Contraseña: <input type="password" name="password"><br>
        Confirmar contraseña: <input type="password" name="confirm"><br>
        <input type="submit" value="Registrarse" name="submit">
    </form>

</body>
</html>