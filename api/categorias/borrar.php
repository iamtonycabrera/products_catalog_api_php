<?php

// Encabezados
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/basemysql.php';
include_once '../../models/categoria.php';

// Instanciar la db y conexion
$basedatos = new Basemysql();
$db = $basedatos->connect();

// Instanciar el objeto categoria
$categoria = new Categoria($db);

$data = json_decode(file_get_contents("php://input"));

// Set el id de categoria
$categoria->id = $data->id;

// Actualizar categoria
if ($categoria->borrar()) {
    echo json_encode(array('message' => 'Categoria eliminada', 'id' => $categoria->id));
} else {
    echo json_encode(array('message' => 'Categoria no eliminada'));
}