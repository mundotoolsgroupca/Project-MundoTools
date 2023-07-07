<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        if ($_POST['_method'] == "PUT") {
            session_name("ecomercer_admin_data");
            session_start();
            include_once '../../php/FuncionesGenerales.php';
            $http = getallheaders();
            if (!empty($http['X-Csrf-Token'])) {

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

                if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {

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
                    $consulta = " ";
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

        break;
}
