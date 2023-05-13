<?php

// Encabezados
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/basemysql.php';
include_once '../../models/producto.php';

// Instanciar la db y conexion
$basedatos = new Basemysql();
$db = $basedatos->connect();

// Instanciar el objeto producto
$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

$producto->titulo = $data->titulo;
$producto->texto = $data->texto;
$producto->categoria_id = $data->categoria_id;

// Crear categoria
if ($producto->crear()) {
    echo json_encode(array('message' => 'Producto creado', 'titulo' => $producto->titulo, 'texto' => $producto->texto, 'categoria_id' => $producto->categoria_id));
} else {
    echo json_encode(array('message' => 'Producto no creado'));
}