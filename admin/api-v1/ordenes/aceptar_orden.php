<?php

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        break;
    case 'POST':
        include_once '../../php/FuncionesGenerales.php';
        include_once '../../php/conexion.php';
        session_name("ecomercer_admin_data");
        session_start();
        $http = getallheaders();
        if (!empty($http['X-Csrf-Token'])) {

            if (!isset($_SESSION['Usuario'])) {
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Parametro No Valido';
                echo json_encode($resultado);
                return;
            }

            if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {



                if (isset($_POST['data'])) {
                    $data = $_POST['data'];
                } else {
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    break;
                }
                if (isset($_POST['modal_idorden_temp'])) {
                    $id_orden = $_POST['modal_idorden_temp'];
                } else {
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    break;
                }


                if (!validar_int($id_orden)) {
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Id Orden no Valida No Valida';
                    echo json_encode($resultado);
                    return;
                }

                for ($i = 0; $i < count($data); $i++) {
                    if (!validar_int($data[$i]['producto_id'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id No Valido';
                        echo json_encode($resultado);
                        return;
                    }

                    if (!validar_int($data[$i]['cantidad'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Cantida No Valida';
                        echo json_encode($resultado);
                        return;
                    }
                }


                $id_admin = $_SESSION['Usuario']['id'];
                $consulta = "CALL adm_devolucion_parcial('$id_admin','$id_orden')";

                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado) {
                    $row = mysqli_fetch_assoc($resultado);
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
                    $resultado->mensaje = 'Error Interno';
                    echo json_encode($resultado);
                    break;
                }
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


        break;
}
