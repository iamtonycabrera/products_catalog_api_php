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

    // Contar las filas
    $numRows = $resultado->rowCount();

    // Validamos si existe categoria
    if($numRows > 0){
        $categoria_arr = array();
        $categoria_arr['data'] = array();

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $categoria_item = array(
                'id' => $id,
                'nombre' => $nombre,
            );

            // Enviar datos
            array_push($categoria_arr['data'], $categoria_item);
        }
        // Enviar formato json
        echo json_encode($categoria_arr);
    } else {
        // No hay categorias
        echo json_encode(array('message' => 'No existen categorías'));
    }
