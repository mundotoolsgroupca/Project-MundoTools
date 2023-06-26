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



                if (isset($_POST['arr_original'])) {
                    $arr_original = $_POST['arr_original'];
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
                if (isset($_POST['arr_original_modificado'])) {
                    $arr_original_modificado = $_POST['arr_original_modificado'];
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

                //validamos el id de la orden
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

                //validamos los datos del array
                for ($i = 0; $i < count($arr_original); $i++) {
                    if (!validar_int($arr_original[$i]['producto_id'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id No Valido';
                        echo json_encode($resultado);
                        return;
                    }

                    if (!validar_int($arr_original[$i]['cantidad'])) {
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
                for ($i = 0; $i < count($arr_original_modificado); $i++) {
                    if (!validar_int($arr_original_modificado[$i]['producto_id'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id No Valido';
                        echo json_encode($resultado);
                        return;
                    }

                    if (!validar_int($arr_original_modificado[$i]['cantidad'])) {
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

                    for ($i = 0; $i < count($arr_original_modificado); $i++) {
                        $producto_id = $arr_original_modificado[$i]['producto_id'];
                        $cantidad = $arr_original_modificado[$i]['cantidad'];
                        $arr_filter = buscarPorId($arr_original, $producto_id);

                    

                        if ($arr_filter != null) {

                            $cantidad_inicial = $arr_filter['cantidad'];
                            $cantidad_final = $arr_filter['cantidad'] - $cantidad;
                            $consulta2 = "CALL adm_devolucion_parcial_det ('$id_orden','$producto_id','$cantidad_inicial','$cantidad_final')";
                            $resultado = mysqli_query($conexion, $consulta);

                            if (!$resultado) {
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
                            $resultado->mensaje = 'Error Interno';
                            echo json_encode($resultado);
                            break;
                        }
                    }

                   

                    http_response_code(200); //Success 
                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = $row['msg'];
                    $resultado->data = $row;
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
