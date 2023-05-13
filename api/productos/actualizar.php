<?php

// Encabezados
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/basemysql.php';
include_once '../../models/producto.php';

// Instanciar la db y conexion
$basedatos = new Basemysql();
$db = $basedatos->connect();

// Instanciar el objeto producto
$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

// Set el producto
$producto->id = $data->id;
$producto->titulo = $data->titulo;
$producto->texto = $data->texto;
$producto->categoria_id = $data->categoria_id;

// Actualizar producto
if ($producto->actualizar()) {
    echo json_encode(array('message' => 'Producto modificado', 'id' => $producto->id, 'titulo' => $producto->titulo, 'texto' => $producto->texto, 'categoria_id' => $producto->categoria_id));
} else {
    echo json_encode(array('message' => 'Producto no modificado'));
}