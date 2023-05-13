<?php

    // Encabezados
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/basemysql.php';
    include_once '../../models/productos.php';

    // Instanciar la db y conexion
    $basedatos = new Basemysql();
    $db = $basedatos->connect();

    // Instanciar el objeto categoria
    $producto = new Producto($db);
    $resultado = $producto->leer();

    // Contar las filas
    $numRows = $resultado->rowCount();

    // Validamos si existe categoria
    if($numRows > 0){
        $producto_arr = array();
        // $producto_arr['data'] = array();

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $producto_item = array(
                'id' => $id,
                'titulo' => $titulo,
                'texto' => $texto,
                'categoria_id' => $categoria_id,
                'categoria_nombre' => $categoria_nombre,
            );

            // Enviar datos
            array_push($producto_arr, $producto_item);
        }
        // Enviar formato json
        echo json_encode($producto_arr);
    } else {
        // No hay categorias
        echo json_encode(array('message' => 'No existen productos'));
    }
