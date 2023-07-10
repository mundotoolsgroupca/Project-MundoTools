<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':

        session_name("ecomercer_admin_data");
        session_start();
        include_once '../../php/FuncionesGenerales.php';
        $http = getallheaders();
        if (!empty($http['X-Csrf-Token'])) {

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
            if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {

                if ($_POST['_method'] == "PUT") {

                    if (isset($_POST['activo']) && validar_int($_POST['activo'])) {
                        $activo =  $_POST['activo'];
                        $activo =  eliminar_palabras_sql($activo);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro No Valido';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['id_usuario']) && validar_string($_POST['id_usuario'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $id_usuario = $_POST['id_usuario'];
                        $id_usuario = eliminar_palabras_sql($id_usuario);
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


                    include_once '../../php/conexion.php';
                    $consulta = "CALL adm_activar_suspender_usuario('" . $_SESSION['Usuario']['id'] . "','$id_usuario','1')";
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
