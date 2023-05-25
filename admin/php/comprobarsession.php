<?php
header('Content-Type: application/json');
include "../php/FuncionesGenerales.php";
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

        $resultado = new stdClass();
        $resultado->result = TRUE;
        $resultado->icono = "success";
        $resultado->titulo = "";
        $resultado->mensaje = "";
        $resultado->data = comprobar_session();
        http_response_code(200);
        echo  json_encode($resultado);
        break;
}
