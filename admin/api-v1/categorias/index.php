<?php

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

        if (!isset($_GET['_method'])) {
            include_once '../../php/conexion.php';
            include_once '../../php/FuncionesGenerales.php';
            // Configurar los encabezados de la respuesta
            header('Content-Type: application/json');

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

                    $consulta = " SELECT categorias.* FROM  categorias ";

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
        } elseif ($_GET['_method'] == "DELETE") {

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
                    if (isset($_GET['id']) && validar_int($_GET['id'])) {
                        $idCategoria = $_GET['id'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Categoria no Valida';
                        echo json_encode($resultado);
                        break;
                    }

                    include_once '../../php/conexion.php';
                    // Configurar los encabezados de la respuesta
                    header('Content-Type: application/json');

                    $consulta = "call adm_eliminar_categoria('$idCategoria','" . $_SESSION['Usuario']['id'] . "')";
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);
                    if ($resultado) { //* si realizo la consulta 
                        if ($data['status'] == 1) {  //* si guardo el producto
                            http_response_code(200);
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];
                            $resultado->data = '';
                            echo  json_encode($resultado);
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
        break;
    case 'POST':
        if (!isset($_POST['_method'])) {

            session_name("ecomercer_admin_data");
            session_start();
            include_once '../../php/FuncionesGenerales.php';
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

                    if (isset($_POST['nuevacategoria']) && validar_string($_POST['nuevacategoria'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $nuevacategoria = $_POST['nuevacategoria'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Categoria no Valida';
                        echo json_encode($resultado);
                        break;
                    }

                    include_once '../../php/conexion.php';

                    $consulta = "call adm_agregar_categoria('$nuevacategoria','" . $_SESSION['Usuario']['id'] . "')";
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);
                    if ($resultado) { //* si realizo la consulta 
                        if ($data['status'] == 1) {  //* si guardo el producto
                            http_response_code(200);
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];
                            $resultado->data = "";

                            echo  json_encode($resultado);
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

        if ($_POST['_method'] == "PUT") {
            session_name("ecomercer_admin_data");
            session_start();
            include_once '../../php/FuncionesGenerales.php';
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

                    if (isset($_POST['newdata']['nombre']) && validar_string($_POST['newdata']['nombre'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $newname =  $_POST['newdata']['nombre'];
                        $newname =  eliminar_palabras_sql($newname);
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
                    if (isset($_POST['newdata']['id']) && validar_int($_POST['newdata']['id'])) {
                        $idCategoria =   $_POST['newdata']['id'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id No Valido';
                        echo json_encode($resultado);
                        break;
                    }


                    include_once '../../php/conexion.php';
                    // Configurar los encabezados de la respuesta
                    header('Content-Type: application/json');
                    $consulta = "call adm_editar_categoria('$idCategoria','$newname','" . $_SESSION['Usuario']['id'] . "')";
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
    case 'DELETE':
}
