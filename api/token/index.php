<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

        session_name("ecomercer_user_data");
        session_start();
        $http = getallheaders();
        if (!empty($http['X-Csrf-Token'])) {

            if (!isset($_SESSION['usuario'])) {
                http_response_code(409); //codigo de conflicto
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
                $id_vendedor = $_SESSION['usuario']['id'];
                include_once '../../php/conexion.php';
                $consulta = "
                SELECT
                    vendedores_tokens.id,
                    vendedores_tokens.id_vendedor,
                    vendedores_tokens.fecha_creacion,
                    vendedores_tokens.fecha_vencimiento,
                    vendedores_tokens.token,
                    vendedores_tokens.`status` ,
	                vendedores_tokens.`responsable` 
                FROM
                    vendedores_tokens 
                WHERE
                    id_vendedor = '$id_vendedor'";
                $data = [];
                $resultado = mysqli_query($conexion, $consulta);

                if ($resultado) {
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
                    break; //retornamos los datos 
                } else {
                    http_response_code(409); //codigo de conflicto
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Error Interno';
                    echo json_encode($resultado);
                    return;
                }
            } else {
                http_response_code(409); //codigo de conflicto
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
            http_response_code(409); //codigo de conflicto
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'El token no fue enviado en el formulario';
            echo json_encode($resultado);
            break;
        }

    case 'POST':



        if (!isset($_POST['_method'])) {
            session_name("ecomercer_user_data");
            session_start();
            $http = getallheaders();
            if (!empty($http['X-Csrf-Token'])) {

                if (!isset($_SESSION['usuario'])) {
                    http_response_code(409); //codigo de conflicto
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




                    include_once '../../php/conexion.php';
                    include_once '../../php/FuncionesGenerales.php';




                    if (isset($_POST['nombre_del_responsable']) && validar_string($_POST['nombre_del_responsable'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $nombre_del_responsable = htmlspecialchars($_POST['nombre_del_responsable'], ENT_QUOTES, 'UTF-8');
                        $nombre_del_responsable = eliminar_palabras_sql($nombre_del_responsable);
                    } else {
                        http_response_code(409); //error
                        // Log this as a warning and keep an eye on these attempts
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro No Valido';
                        echo json_encode($resultado);
                        break;
                    }


                    $id_vendedor = $_SESSION['usuario']['id'];

                    // $token = generarToken();
                    $consulta = "CALL usr_agregar_token('$id_vendedor','$nombre_del_responsable');";
                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado) {
                        $row = mysqli_fetch_assoc($resultado);
                        http_response_code(200); //Success
                        $resultado = new stdClass();
                        $resultado->result = TRUE;
                        $resultado->icono = "success";
                        $resultado->titulo = "";
                        $resultado->mensaje = "";
                        $resultado->data = $row['token'];

                        echo  json_encode($resultado);
                        break; //retornamos los datos 
                    } else {
                        http_response_code(409); //codigo de conflicto
                        // Log this as a warning and keep an eye on these attempts
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Error Interno';
                        echo json_encode($resultado);
                        return;
                    }
                } else {
                    http_response_code(409); //codigo de conflicto
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
                http_response_code(409); //codigo de conflicto
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'El token no fue enviado en el formulario';
                echo json_encode($resultado);
                break;
            }
        }



        if (isset($_POST['_method']) && $_POST['_method']  == 'PUT') {
            session_name("ecomercer_user_data");
            session_start();
            $http = getallheaders();
            if (!empty($http['X-Csrf-Token'])) {

                if (!isset($_SESSION['usuario'])) {
                    http_response_code(409); //codigo de conflicto
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
                    include_once '../../php/FuncionesGenerales.php';
                    if (isset($_POST['token']) && validar_string($_POST['token'], 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')) {
                        $token = $_POST['token'];
                        $token = eliminar_palabras_sql($token);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Token de Un Solo Uso No Valido';
                        echo json_encode($resultado);
                        return  $resultado;
                    }


                    include_once '../../php/conexion.php';

                    $id_vendedor = $_SESSION['usuario']['id'];
                    $consulta = "CALL usr_cancelar_token('$id_vendedor','$token')";
                    $resultado = mysqli_query($conexion, $consulta);
                    if ($resultado) {
                        $data = mysqli_fetch_assoc($resultado);
                        if ($data['status'] == 1) {
                            http_response_code(200); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];

                            echo  json_encode($resultado);
                            return;
                        } else {
                            // Log this as a warning and keep an eye on these attempts
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = FALSE;
                            $resultado->icono = "error";
                            $resultado->titulo = "Error!";
                            $resultado->mensaje = $data['msg'];
                            echo json_encode($resultado);
                            return;
                        }
                    } else {
                        // Log this as a warning and keep an eye on these attempts
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Error Intenro';
                        echo json_encode($resultado);
                        return;
                    }
                } else {
                    // Log this as a warning and keep an eye on these attempts
                    http_response_code(409); //codigo de conflicto
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'El token enviado no es valido';
                    echo json_encode($resultado);
                    return;
                }
            } else {
                http_response_code(409); //codigo de conflicto
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'El token no fue enviado en el formulario';
                echo json_encode($resultado);
                return;
            }
        }
}
