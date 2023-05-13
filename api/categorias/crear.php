<?php

// Encabezados
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/basemysql.php';
include_once '../../models/categoria.php';

// Instanciar la db y conexion
$basedatos = new Basemysql();
$db = $basedatos->connect();

// Instanciar el objeto categoria
$categoria = new Categoria($db);

$data = json_decode(file_get_contents("php://input"));

$categoria->nombre = $data->nombre;

// Crear categoria
if ($categoria->crear()) {
    echo json_encode(array('message' => 'Categoria creada', 'nombre' => $categoria->nombre));
} else {
    echo json_encode(array('message' => 'Categoria no creada'));
}