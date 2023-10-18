<?php

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        session_name("ecomercer_admin_data");
 session_start(); 
        $http = getallheaders();
        if (!empty($http['x-csrf-token'] )) {
            if (!isset($_SESSION['token'])) {
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Parametro No Valido';
                echo json_encode($resultado);
                break;
            }


            if (hash_equals($_SESSION['token'], $http['x-csrf-token'] )) {

                include_once '../../php/conexion.php';
                // Configurar los encabezados de la respuesta
                header('Content-Type: application/json');
                $consulta = "SELECT * FROM moneda_ref";
                $resultado = mysqli_query($conexion, $consulta);
                $data = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    array_push($data, $row);
                }
                $resultado = new stdClass();
                $resultado->result = TRUE;
                $resultado->icono = "success";
                $resultado->titulo = "";
                $resultado->mensaje = "";
                $resultado->data = $data;

                echo  json_encode($resultado);
                break;
            } else {
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'El token enviado no es valido';
                echo json_encode($resultado);
                break;
            }
        } else {
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'El token no fue enviado en el formulario';
            echo json_encode($resultado);
            break;
        }
}
