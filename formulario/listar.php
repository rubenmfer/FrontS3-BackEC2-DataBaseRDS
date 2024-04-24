<?php

try {

    $conexion = new PDO("mysql:host=localhost;port=3306;dbname=base_datos", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $res = $conexion->query('SELECT * FROM usuarios') or die(print($conexion->errorInfo()));

    $data = [];

    while($item = $res->fetch(PDO::FETCH_OBJ)) {

        $data[] = [
            'id' => $item->id,
            'nombre' => $item->nombre,
            'apellido' => $item->apellido,
            'edad' => $item->edad,
            'genero' => $item->genero,
            'email' => $item->email,
            'celular' => $item->celular,
            'cargo' => $item->cargo,
            'habilitado' => $item->habilitado
        ];

    }

    echo json_encode($data);

} catch(PDOException $error) {

    echo $error->getMessage();
    die();

}