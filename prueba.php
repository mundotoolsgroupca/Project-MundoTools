<?php

header('Content-Type: application/json');
include_once("./php/conexion.php");

$consulta = "SELECT JSON_ARRAYAGG(JSON_OBJECT('id', id, 'nombre', nombre)) AS productos_json FROM categorias;";
$resultado = mysqli_query($conexion, $consulta);
$row = mysqli_fetch_assoc($resultado);

echo json_encode($row);
