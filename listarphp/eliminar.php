<?php

try {

    $id = $_POST['id'];

    $dbHost ='database-1.cqvj2fur6lmt.us-east-1.rds.amazonaws.com';
    $dbName = 'mibd';
    $dbUser = 'admin';
    $dbPass = 'mysql123';

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
 
    $conexion = new PDO($dsn, $dbUser, $dbPass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $res = $conexion->query('DELETE FROM datos_contacto WHERE id = '.$id) or die(print($conexion->errorInfo()));






} catch(PDOException $error) {

    echo $error->getMessage();
    die();

}
