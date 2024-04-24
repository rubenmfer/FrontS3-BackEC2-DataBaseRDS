<?php

try {

    $dbHost ='database-1.cqvj2fur6lmt.us-east-1.rds.amazonaws.com';
    $dbName = 'mibd';
    $dbUser = 'admin';
    $dbPass = 'mysql123';

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
 




    $conexion = new PDO($dsn, $dbUser, $dbPass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $res = $conexion->query('SELECT * FROM datos_contacto') or die(print($conexion->errorInfo()));

    $data = [];

    while($item = $res->fetch(PDO::FETCH_OBJ)) {

        $data[] = [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'message' => $item->message
        ];

    }

    echo json_encode($data);

} catch(PDOException $error) {

    echo $error->getMessage();
    die();

}
