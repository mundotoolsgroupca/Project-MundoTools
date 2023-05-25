<?php

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        include_once '../../php/conexion.php';
        // Configurar los encabezados de la respuesta
        header('Content-Type: application/json');

        $consulta = " SELECT categorias.* FROM  categorias ";
        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
            $data = [];
            while ($row = mysqli_fetch_assoc($resultado)) {
                array_push($data, $row);
            }
            echo json_encode($data);
            break;
        } else {
            http_response_code(409);
            return
                array(
                    "status" => 0,
                    "msg" => "Error Interno"

                );
        }
}
