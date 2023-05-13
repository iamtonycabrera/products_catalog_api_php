<?php

    // Encabezados
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/basemysql.php';
    include_once '../../models/producto.php';

    // Instanciar la db y conexion
    $basedatos = new Basemysql();
    $db = $basedatos->connect();

    // Instanciar el objeto categoria
    $producto = new Producto($db);
    $resultado = $producto->leer();

    // Obtener id
    $producto->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Obtener categoria
    $producto->leer_individual();

    $producto_arr = array(
        'id' => $producto->id,
        'titulo' => $producto->titulo,
        'texto' => $producto->texto,
        'categoria_id' => $producto->categoria_id,
        'categoria_nombre' => $producto->categoria_nombre,
    );

    // Crear json
    print_r(json_encode($producto_arr));