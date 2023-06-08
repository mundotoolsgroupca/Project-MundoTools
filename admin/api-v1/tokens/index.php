<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        include_once '../../php/FuncionesGenerales.php';
        session_name("ecomercer_admin_data");
        session_start();
        $http = getallheaders();
        if (!empty($http['X-Csrf-Token'] )) {

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


            if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'] )) {
                /*
                if (isset($_GET['fecha']) && validar_fecha($_GET['fecha'], 'Y-m-d')) {
                    $fecha = $_GET['fecha'];
                } else {

                    http_response_code(409); //error
                    $resultado = new stdClass();
                    $resultado->result = false;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "Fecha No Valida";

                    echo  json_encode($resultado);
                    break;
                }
*/
                include_once '../../php/conexion.php';
                // Configurar los encabezados de la respuesta
                header('Content-Type: application/json');

                $consulta = "
                SELECT
                vendedores.nombre_usuario,
                vendedores_tokens.id,
                vendedores_tokens.fecha_creacion,
                vendedores_tokens.fecha_vencimiento,
                vendedores_tokens.token,
                vendedores_tokens.`status`,
                vendedores_tokens.`responsable`
                FROM
                vendedores_tokens
                INNER JOIN vendedores ON vendedores_tokens.id_vendedor = vendedores.id
                ";
                $resultado = mysqli_query($conexion, $consulta);
                $data = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    array_push($data, $row);
                }
                http_response_code(200); //Success 
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
                http_response_code(409); //error
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'El token enviado no es valido';
                echo json_encode($resultado);
                break;
            }
        } else {
            http_response_code(409); //error
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'El token no fue enviado en el formulario';
            echo json_encode($resultado);
            break;
        }
}
