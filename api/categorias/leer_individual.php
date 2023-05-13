<?php

    // Encabezados
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/basemysql.php';
    include_once '../../models/categoria.php';

    // Instanciar la db y conexion
    $basedatos = new Basemysql();
    $db = $basedatos->connect();

    // Instanciar el objeto categoria
    $categoria = new Categoria($db);
    $resultado = $categoria->leer();

    // Obtener id
    $categoria->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Obtener categoria
    $categoria->leer_individual();

    $categoria_arr = array(
        'id' => $categoria->id,
        'nombre' => $categoria->nombre
    );

    // Crear json
    print_r(json_encode($categoria_arr));