<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
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
        session_start();
            $username=$_POST['username'] ??"";
            $password=$_POST['password'] ?? "";
            $sql="SELECT * from users where username='$username' and password='$password'";
        $resultado= $pdo->query($sql);

        if($registro=$resultado->fetch())  {
            $_SESSION['username']= $registro['username'];
        }else{
            echo 'El usuario no existe';
        }
        
        header('local: pagina_privada.php');
    ?>

    <form action="elformu.php" method="post" enctype="multipart/form-data">
        Nombre usuario: <input type="texto" name="username"><br>
        Contraseña: <input type="password" name="password"><br>
        <input type="submit" value="Loguearse" name="submit">
    </form>

</body>
</html>