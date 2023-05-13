<?php

// Encabezados
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/basemysql.php';
include_once '../../models/producto.php';

// Instanciar la db y conexion
$basedatos = new Basemysql();
$db = $basedatos->connect();

// Instanciar el objeto producto
$producto = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

// Set el id de producto
$producto->id = $data->id;

// Eliminar producto
if ($producto->borrar()) {
    echo json_encode(array('message' => 'Producto eliminado', 'id' => $producto->id));
} else {
    echo json_encode(array('message' => 'Producto no eliminada'));
}