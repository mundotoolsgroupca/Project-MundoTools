<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        session_name("ecomercer_admin_data");
        session_start();
        include_once '../../php/FuncionesGenerales.php';
        $http = getallheaders();
        if (!empty($http['x-csrf-token'])) {

            if (!isset($_SESSION['token'])) {
                http_response_code(409); //codigo de conflicto
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Parametro No Valido';
                echo json_encode($resultado);
                break;
            }

            if (hash_equals($_SESSION['token'], $http['x-csrf-token'])) {
                include_once '../../php/conexion.php';
                // Configurar los encabezados de la respuesta
                header('Content-Type: application/json');
                $consulta = "
                SELECT 
                vendedores.nombre_usuario, 
                vendedores.nombre, 
                vendedores.apellido, 
                vendedores.zona, 
                vendedores.activo, 
                vendedores.id
            FROM
                vendedores";
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado) { //* si realizo la consulta 
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
                } else { //! si hubo un error
                    http_response_code(409); //codigo de conflicto
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Error Interno';
                    echo json_encode($resultado);
                    break;
                }
            }
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
        break;
    case 'POST':

        session_name("ecomercer_admin_data");
        session_start();
        include_once '../../php/FuncionesGenerales.php';
        $http = getallheaders();
        if (!empty($http['x-csrf-token'])) {

            if (!isset($_SESSION['token'])) {
                http_response_code(409); //codigo de conflicto
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Parametro No Valido';
                echo json_encode($resultado);
                break;
            }



            if (hash_equals($_SESSION['token'], $http['x-csrf-token'])) {
                if (!isset($_POST['_method'])) {

                    if (!isset($_POST['data'])) {
                        http_response_code(409); //codigo de conflicto
                        // Log this as a warning and keep an eye on these attempts
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro No Valido';
                        echo json_encode($resultado);
                        break;
                    }

                    $formDataString = $_POST['data'];
                    $formDataArray = array();
                    parse_str($formDataString, $formDataArray);
                    $_POST['data'] = $formDataArray;

                    if (isset($_POST['data']['Nombre']) && validar_string($_POST['data']['Nombre'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $nombre =  $_POST['data']['Nombre'];
                        $nombre =  eliminar_palabras_sql($nombre);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Nombre No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['apellido']) && validar_string($_POST['data']['apellido'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $apellido =  $_POST['data']['apellido'];
                        $apellido =  eliminar_palabras_sql($apellido);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'apellido No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['nombre_usuario']) && validar_string($_POST['data']['nombre_usuario'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $nombre_usuario =  $_POST['data']['nombre_usuario'];
                        $nombre_usuario =  eliminar_palabras_sql($nombre_usuario);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Nombre de Usuario No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['clave']) && validar_string($_POST['data']['clave'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $clave =  $_POST['data']['clave'];
                        $clave =  eliminar_palabras_sql($clave);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Clave No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    include_once '../../php/conexion.php';
                    // Configurar los encabezados de la respuesta
                    header('Content-Type: application/json');
                    $consulta = "CALL adm_agregar_usuario('$nombre_usuario','$nombre','$apellido','','$clave','" . $_SESSION['Usuario']['id'] . "')";
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);
                    if ($resultado) { //* si realizo la consulta 
                        if ($data['status'] == 1) {  //* si guardo el producto
                            http_response_code(200);
                            $resultado = new stdClass();
                            $resultado->result = true;
                            $resultado->icono = "succes";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];
                            echo json_encode($resultado);
                            break;
                        } elseif ($data['status'] == 0) { //! si no lo guardo 
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = FALSE;
                            $resultado->icono = "error";
                            $resultado->titulo = "Error!";
                            $resultado->mensaje = $data['msg'];
                            echo json_encode($resultado);
                            break;
                        }
                    } else { //! si hubo un error
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Error Interno';
                        echo json_encode($resultado);
                        break;
                    }
                    break;
                }
                if ($_POST['_method'] == "PUT") {
                    if (!isset($_POST['data'])) {
                        http_response_code(409); //codigo de conflicto
                        // Log this as a warning and keep an eye on these attempts
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro No Valido';
                        echo json_encode($resultado);
                        break;
                    }

                    $formDataString = $_POST['data'];
                    $formDataArray = array();
                    parse_str($formDataString, $formDataArray);
                    $_POST['data'] = $formDataArray;

                    if (isset($_POST['data']['modal_editar_id_usuario']) && validar_int($_POST['data']['modal_editar_id_usuario'])) {
                        $modal_editar_id_usuario =  $_POST['data']['modal_editar_id_usuario'];
                        $modal_editar_id_usuario =  eliminar_palabras_sql($modal_editar_id_usuario);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id Usuario No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['modal_editar_usuario_nombre']) && validar_string($_POST['data']['modal_editar_usuario_nombre'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $modal_editar_usuario_nombre =  $_POST['data']['modal_editar_usuario_nombre'];
                        $modal_editar_usuario_nombre =  eliminar_palabras_sql($modal_editar_usuario_nombre);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Nombre No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['modal_editar_usuario_apellido']) && validar_string($_POST['data']['modal_editar_usuario_apellido'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $modal_editar_usuario_apellido =  $_POST['data']['modal_editar_usuario_apellido'];
                        $modal_editar_usuario_apellido =  eliminar_palabras_sql($modal_editar_usuario_apellido);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Apellido No Valido';
                        echo json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['data']['modal_editar_usuario_clave']) && validar_string2($_POST['data']['modal_editar_usuario_clave'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $modal_editar_usuario_clave =  $_POST['data']['modal_editar_usuario_clave'];
                        $modal_editar_usuario_clave =  eliminar_palabras_sql($modal_editar_usuario_clave);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Clave No Valida';
                        echo json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['data']['modal_editar_activo']) && validar_int($_POST['data']['modal_editar_activo'])) {

                        $modal_editar_activo =  $_POST['data']['modal_editar_activo'];
                        $modal_editar_activo =  eliminar_palabras_sql($modal_editar_activo);
                        if ($modal_editar_activo != "0" && $modal_editar_activo != "1") {
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = FALSE;
                            $resultado->icono = "error";
                            $resultado->titulo = "Error!";
                            $resultado->mensaje = 'Codigo no Valido No Valido';
                            echo json_encode($resultado);
                            break;
                        }
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Status No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    include_once '../../php/conexion.php';
                    $consulta = "CALL adm_editar_usuario('$modal_editar_id_usuario','$modal_editar_usuario_nombre','$modal_editar_usuario_apellido','$modal_editar_usuario_clave','" . $_SESSION['Usuario']['id'] . "')";
                    $resultado = mysqli_query($conexion, $consulta);

                    $dataquery = mysqli_fetch_assoc($resultado);
                    if ($resultado) { //* si realizo la consulta sin problemas

                        if ($dataquery['status'] == 1) {
                            http_response_code(200);
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $dataquery['msg'];
                            $resultado->data = array(
                                "status" => $dataquery['status'],
                                "msg" => $dataquery['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        } elseif ($dataquery['status'] == 0) {
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $dataquery['msg'];
                            $resultado->data = array(
                                "status" => $dataquery['status'],
                                "msg" => $dataquery['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        }
                    } else { //! si hubo un fallo 
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "success";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Error Interno";
                        echo  json_encode($resultado);
                        break;
                    }

                    break;
                }
            }
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

        break;
}
