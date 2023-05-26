<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $http = getallheaders();
        session_name("ecomercer_user_data");
        session_start();

        if (!empty($http['X-Csrf-Token'])) {

            if (!isset($_SESSION['usuario']['id'])) {
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Parametro no Valido';
                echo json_encode($resultado);
                return;
            }

            if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {

                include_once '../../php/FuncionesGenerales.php';
                if (isset($_GET['fecha']) && validar_fecha($_GET['fecha'])) {
                    $fecha = $_GET['fecha'];
                    $fecha = eliminar_palabras_sql($fecha);
                } else {
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Fecha no Valida';
                    echo json_encode($resultado);
                    return;
                }
                $id_vendedor = $_SESSION['usuario']['id'];
                $consulta = "
                    SELECT
                    ordenes.id,
                    ordenes.id_vendedor,
                    ordenes.nombreempresa,
                    ordenes.responsable,
                    ordenes.numerotelefono,
                    ordenes.rif,
                    ordenes.direccion,
                    ordenes.fecha,
                    ordenes.status,
                    moneda_ref.simbolo AS moneda_simbolo
                    FROM
                    ordenes
                    INNER JOIN moneda_ref ON ordenes.moneda = moneda_ref.cod_moneda
                    WHERE
                    ordenes.id_vendedor = '$id_vendedor'
                    AND DATE(ordenes.fecha) = '$fecha';   ";

                include_once '../../php/conexion.php';
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado) {
                    $json = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push($json, $row);
                    }
                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "";
                    $resultado->data = $json;

                    echo  json_encode($resultado);
                    break;
                } else {
                    // Log this as a warning and keep an eye on these attempts
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

    case 'POST':
        if (!isset($_POST['_method'])) {
            $http = getallheaders();
            session_name("ecomercer_user_data");
            session_start();
            if (!empty($http['X-Csrf-Token'])) {


                if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {
                    include_once '../../php/FuncionesGenerales.php';
                    include_once '../../php/conexion.php';

                    $formDataString =  $_POST['formData'];
                    $formDataArray = array();
                    parse_str($formDataString, $formDataArray);


                    agregar_orden($formDataArray, $_POST['carritostorage'], $_POST['check_correo'], $_POST['correo']);
                } else {
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'El token enviado no es valido';
                    echo json_encode($resultado);
                    return;
                }
            } else {

                $formDataString =  $_POST['formData'];
                $formDataArray = array();
                parse_str($formDataString, $formDataArray);


                agregar_orden($formDataArray, $_POST['carritostorage'], $_POST['check_correo'], $_POST['correo']);
                break;
                /*
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'El token no fue enviado en el formulario';
                echo json_encode($resultado);
                return;*/
            }
        }
        if (isset($_POST['_method']) && $_POST['_method'] == "PUT") {

            $http = getallheaders();
            session_name("ecomercer_user_data");
            session_start();
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

                    if (isset($_POST['id_orden']) && validar_int($_POST['id_orden'])) {
                        $id_orden = $_POST['id_orden'];
                        $id_orden = eliminar_palabras_sql($id_orden);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id De La Orden,No Valido';
                        echo json_encode($resultado);
                        return  $resultado;
                    }


                    include_once '../../php/conexion.php';

                    $id_vendedor = $_SESSION['usuario']['id'];
                    $consulta = "CALL  usr_cancelar_orden('$id_vendedor','$id_orden');";
                    $resultado = mysqli_query($conexion, $consulta);
                    $newid = "";
                    if ($resultado) {
                        $data = mysqli_fetch_assoc($resultado);
                        if ($data['status'] == 0) {
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = FALSE;
                            $resultado->icono = "error";
                            $resultado->titulo = "Error!";
                            $resultado->mensaje = $data['msg'];
                            echo json_encode($resultado);
                            return;
                        } else {
                            http_response_code(200); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = true;
                            $resultado->icono = "";
                            $resultado->titulo = "";
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
                        $resultado->mensaje = 'Error Interno';
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


        break;
}

function obtenerid_token($formDataArray, $carritostorage) //se inserta el registro en la tabla ordenes y nos retorna el id, para usarlo como identificador para insartar todos los poductos en ordenes_det
{
    include_once '../../php/FuncionesGenerales.php';




    if (isset($formDataArray['nombreempresa']) && validar_string($formDataArray['nombreempresa'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($formDataArray['nombreempresa']) <= 100) {
        $nombreempresa = $formDataArray['nombreempresa'];
        $nombreempresa = eliminar_palabras_sql($nombreempresa);
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Nombre de la Empresa no Valido';
        echo json_encode($resultado);
        return $resultado;
    }
    if (isset($formDataArray['responsable']) && validar_string($formDataArray['responsable'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($formDataArray['responsable']) <= 100) {
        $responsable = $formDataArray['responsable'];
        $responsable = eliminar_palabras_sql($responsable);
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Responsable no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['telefono']) && validar_string($formDataArray['telefono'], '0123456789-+') && strlen($formDataArray['telefono']) <= 11) {
        $telefono = $formDataArray['telefono'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Telefono No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['nro_documento']) && validar_string($formDataArray['nro_documento'], '0123456789-+') && strlen($formDataArray['nro_documento']) <= 10) {
        $nro_documento = $formDataArray['nro_documento'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Documento no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }
    if (isset($formDataArray['tipo_documento']) && validar_string($formDataArray['tipo_documento'], 'JGEV') && strlen($formDataArray['nro_documento']) <= 1 || $formDataArray['tipo_documento'] == 'J' || $formDataArray['tipo_documento'] == 'G' || $formDataArray['tipo_documento'] == 'E' || $formDataArray['tipo_documento'] == 'V') {
        $tipo_documento = $formDataArray['tipo_documento'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Tipo de Documento no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['direccion']) && validar_string($formDataArray['direccion'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($formDataArray['direccion']) <= 50) {
        $direccion = $formDataArray['direccion'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'direccion No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }
    if (isset($formDataArray['token']) && validar_string($formDataArray['token'], 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') && strlen($formDataArray['token']) <= 10) {
        $token = $formDataArray['token'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Token De Un Solo Uso No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['token']) && validar_string($formDataArray['token'], 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') && strlen($formDataArray['token']) <= 10) {
        $token = $formDataArray['token'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Check no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }







    include_once '../../php/conexion.php';



    $id_vendedor = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : 0;
    $tipo = isset($_SESSION['usuario']['id']) ? 1 : 2;
    $consulta = "CALL usr_agregar_orden($id_vendedor,'$nombreempresa','$responsable','$telefono','$tipo_documento" . "-" . "$nro_documento','$direccion'," . intval($carritostorage[0]['cod_moneda']) . ",'$token',$tipo);"; //consulta para obtener los resultados segun la pagina 
    $resultado = mysqli_query($conexion, $consulta);
    $newid = "";
    if ($resultado) {
        $data = mysqli_fetch_assoc($resultado);
        $newid = isset($data['data']) ? $data['data'] : "";
        $status = $data['status'];
        $msg = isset($data['msg']) ? $data['msg'] : "";
        if ($status == 0) {
            http_response_code(409);
            $resultado = new stdClass();
            $resultado->result = false;
            $resultado->icono = "error";
            $resultado->titulo = "";
            $resultado->mensaje = $msg;
            echo  json_encode($resultado);
            return  $resultado;
        }

        $resultado = new stdClass();
        $resultado->result = true;
        $resultado->icono = "";
        $resultado->titulo = "";
        $resultado->mensaje = "";
        $resultado->data = $newid;
        // echo  json_encode($resultado);
        return  $resultado;
    } else {
        http_response_code(409);
        $resultado = new stdClass();
        $resultado->result = false;
        $resultado->icono = "error";
        $resultado->titulo = "";
        $resultado->mensaje = "Error Interno";
        $resultado->data = "";
        echo  json_encode($resultado);
        return  $resultado;
    }
}
function obtenerid($formDataArray, $carritostorage) //se inserta el registro en la tabla ordenes y nos retorna el id, para usarlo como identificador para insartar todos los poductos en ordenes_det
{
    include_once '../../php/FuncionesGenerales.php';




    if (isset($formDataArray['nombreempresa']) && validar_string($formDataArray['nombreempresa'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($formDataArray['nombreempresa']) <= 100) {
        $nombreempresa = $formDataArray['nombreempresa'];
        $nombreempresa = eliminar_palabras_sql($nombreempresa);
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Nombre de la Empresa no Valido';
        echo json_encode($resultado);
        return $resultado;
    }
    if (isset($formDataArray['responsable']) && validar_string($formDataArray['responsable'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($formDataArray['responsable']) <= 100) {
        $responsable = $formDataArray['responsable'];
        $responsable = eliminar_palabras_sql($responsable);
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Responsable no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['telefono']) && validar_string($formDataArray['telefono'], '0123456789-+') && strlen($formDataArray['telefono']) <= 11) {
        $telefono = $formDataArray['telefono'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Telefono No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['nro_documento']) && validar_string($formDataArray['nro_documento'], '0123456789-+') && strlen($formDataArray['nro_documento']) <= 10) {
        $nro_documento = $formDataArray['nro_documento'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Documento no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($formDataArray['tipo_documento']) && validar_string($formDataArray['tipo_documento'], 'JGEV') && strlen($formDataArray['nro_documento']) <= 1 && $formDataArray['tipo_documento'] == 'J' || $formDataArray['tipo_documento'] == 'G' || $formDataArray['tipo_documento'] == 'E' || $formDataArray['tipo_documento'] == 'V') {
        $tipo_documento = $formDataArray['tipo_documento'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Tipo de Documento no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }



    if (isset($formDataArray['direccion']) && validar_string($formDataArray['direccion'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($formDataArray['direccion']) <= 50) {
        $direccion = $formDataArray['direccion'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'direccion No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }





    include '../../php/conexion.php';

    $id_vendedor = $_SESSION['usuario']['id'];
    $tipo =  1;
    $consulta = "CALL usr_agregar_orden($id_vendedor,'$nombreempresa','$responsable','$telefono','$tipo_documento" . "-" . "$nro_documento','$direccion'," . intval($carritostorage[0]['cod_moneda']) . ",'0',$tipo);"; //consulta para obtener los resultados segun la pagina 
    $resultado = mysqli_query($conexion, $consulta);
    $newid = "";
    if ($resultado) {
        $data = mysqli_fetch_assoc($resultado);
        $newid = isset($data['data']) ? $data['data'] : "";
        $status = $data['status'];
        $msg = isset($data['msg']) ? $data['msg'] : "";
        if ($status == 0) {
            http_response_code(409);
            $resultado = new stdClass();
            $resultado->result = false;
            $resultado->icono = "error";
            $resultado->titulo = "";
            $resultado->mensaje = $msg;
            echo  json_encode($resultado);
            return  $resultado;
        }

        $resultado = new stdClass();
        $resultado->result = true;
        $resultado->icono = "";
        $resultado->titulo = "";
        $resultado->mensaje = "";
        $resultado->data = $newid;
        // echo  json_encode($resultado);
        return  $resultado;
    } else {
        http_response_code(409);
        $resultado = new stdClass();
        $resultado->result = false;
        $resultado->icono = "error";
        $resultado->titulo = "";
        $resultado->mensaje = "Error Interno";
        $resultado->data = "";
        echo  json_encode($resultado);
        return  $resultado;
    }
}


function agregardetalle($id, $data, $carritostorage, $check_correo, $correo)
{
    include_once '../../php/FuncionesGenerales.php';
    if (isset($data['nombreempresa']) && validar_string($data['nombreempresa'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($data['nombreempresa']) <= 100) {
        $nombreempresa = $data['nombreempresa'];
        $nombreempresa = eliminar_palabras_sql($nombreempresa);
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Nombre de la Empresa no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }
    if (isset($data['responsable']) && validar_string($data['responsable'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($data['responsable']) <= 100) {
        $responsable = $data['responsable'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Responsable no Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($data['telefono']) && validar_string($data['telefono'], '0123456789-+') && strlen($data['telefono']) <= 11) {
        $telefono = $data['telefono'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Telefono No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($data['nro_documento']) && validar_string($data['nro_documento'], '0123456789-+') && strlen($data['nro_documento']) <= 10) {
        $nro_documento = $data['nro_documento'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Fif No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($data['direccion']) && validar_string($data['direccion'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ') && strlen($data['direccion']) <= 50) {
        $direccion = $data['direccion'];
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'direccion No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }

    if (isset($carritostorage)) {
        $carritostorage = $carritostorage;
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Parametro No Valido';
        echo json_encode($resultado);
        return  $resultado;
    }



    include '../../php/conexion.php';
    $realizados = 0;

    $contenidotabla = "";


    $totalTabla = 0;
    for ($i = 0; $i < count($carritostorage); $i++) {
        $cantidad = $carritostorage[$i]['cantidad'];
        $id_producto = $carritostorage[$i]['id'];
        $precio = $carritostorage[$i]['precio'];
        $nombre = $carritostorage[$i]['nombre'];
        $simbolo = $carritostorage[$i]['simbolo'];
        $consulta2 = "CALL usr_agregar_orden_det($id,'$id_producto', $cantidad, $precio)";
        $resultado2 = mysqli_query($conexion, $consulta2);

        if ($resultado2) {
            // Query was successful
            $realizados = $realizados + 1;
            $contenidotabla .= "<tr style='background-color: #f2f2f2;'>
            <td style='border: 1px solid black; text-align: center; padding: 10px;'>$id_producto</td>
            <td style='border: 1px solid black; text-align: center; padding: 10px;'>$nombre</td>
            <td style='border: 1px solid black; text-align: center; padding: 10px;'>$cantidad</td> 
            <td style='border: 1px solid black; text-align: center; padding: 10px;'>$precio" . '' . "$simbolo</td>
            <td style='border: 1px solid black; text-align: center; padding: 10px;'>" . $precio * $cantidad . '' . $simbolo . " </td>
           
        </tr>";

            $totalTabla += $precio * $cantidad;
        }
    }

    date_default_timezone_set('America/Caracas');
    $fecha_actual = date('Y-m-d');
    $hora_actual = date('h:i A');
    $token = isset($data['token']) ? " <label>Token Utilizado: <label style='font-weight: bold;'>" . $data['token'] . "</label></label><br>" : "";


    $correotabla = "
    <label style='font-size: 2.5em;'>Orden de Compra</label><br>
    <label style='font-weight: bold;'>$nombreempresa</label><br>
    <label>Responsable: <label style='font-weight: bold;'>$responsable</label></label><br>
    <label>Numero de Contacto: <label style='font-weight: bold;'>$telefono</label></label><br>
    <label>Fecha: <label style='font-weight: bold;'>$fecha_actual</label></label><br>
    <label>Hora: <label style='font-weight: bold;'>$hora_actual</label></label><br>
    $token
    <table style='border-collapse: collapse;'>
        <tr>
            <th style='border: 1px solid black; padding: 10px;background-color: black;color:white'>Id</th>
            <th style='border: 1px solid black; padding: 10px;background-color: black;color:white'>Producto</th>
            <th style='border: 1px solid black; padding: 10px;background-color: black;color:white'>Cantidad</th>
            <th style='border: 1px solid black; padding: 10px;background-color: black;color:white'>Precio Unitario</th>
            <th style='border: 1px solid black; padding: 10px;background-color: black;color:white'>Total</th>
        </tr>
        $contenidotabla
    </table>
    <label>Total: <label style='font-weight: bold;'>$totalTabla</label></label><br>";

    include "../../php/correo.php";


    $correo = $data['correo'];
    if ($check_correo == true) {
        $statusEmail =  EnviarCorreo("mundotoolsgroupca@gmail.com", "ryrajpjcmsqkcbmv", "mundotoolsgroupca@gmail.com", "MundoTools", "$correo", "MundoTools", 'Orden', $correotabla);
    }

    $statusEmail =  EnviarCorreo("mundotoolsgroupca@gmail.com", "ryrajpjcmsqkcbmv", "mundotoolsgroupca@gmail.com", "MundoTools", "mundotoolsgroupca@gmail.com", "MundoTools", 'Orden', $correotabla);

    $resultado = new stdClass();
    $resultado->result = TRUE;
    $resultado->icono = "success";
    $resultado->titulo = "";
    $resultado->mensaje = "Orden Enviada";
    $resultado->data = "";

    echo  json_encode($resultado);
    return;
}
function agregar_orden($_DataPOST, $carritostorage, $check_correo, $correo)
{
    include_once '../../php/FuncionesGenerales.php';


    if (isset($carritostorage)) {
        $carritostorage = $carritostorage;
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Parametro No Valido';
        echo json_encode($resultado);
        return;
    }
    if (isset($check_correo) && $check_correo == true) {
        //$check_correo = $check_correo;

        if (!validar_correo($correo)) {
            http_response_code(409); //codigo de conflicto
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Parametro No Valido';
            echo json_encode($resultado);
            return;
        }
    } else {
        http_response_code(409); //codigo de conflicto
        $resultado = new stdClass();
        $resultado->result = FALSE;
        $resultado->icono = "error";
        $resultado->titulo = "Error!";
        $resultado->mensaje = 'Parametro No Valido';
        echo json_encode($resultado);
        return;
    }




    //validamos que los datos del array enviado estan correctos
    for ($i = 0; $i < count($carritostorage); $i++) {


        if (!isset($carritostorage[$i]['cantidad']) || !validar_int($carritostorage[$i]['cantidad'])) {
            http_response_code(409); //codigo de conflicto
            // Log this as a warning and keep an eye on these attempts
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Cantidad No Valido';
            echo json_encode($resultado);
            return;
        }
        if (!isset($carritostorage[$i]['id']) || !validar_string($carritostorage[$i]['id'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
            http_response_code(409); //codigo de conflicto
            // Log this as a warning and keep an eye on these attempts
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Id No Valido';
            echo json_encode($resultado);
            return;
        }


        if (!isset($carritostorage[$i]['precio']) || !validar_Monto($carritostorage[$i]['precio'])) {
            http_response_code(409); //codigo de conflicto
            // Log this as a warning and keep an eye on these attempts
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Precio No Valido';
            echo json_encode($resultado);
            return;
        }
        if (!isset($carritostorage[$i]['nombre']) || !validar_string($carritostorage[$i]['nombre'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/() ')) {
            http_response_code(409); //codigo de conflicto
            // Log this as a warning and keep an eye on these attempts
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Nombre Pruducto No Valido';
            echo json_encode($resultado);
            return;
        }

        if (!isset($carritostorage[$i]['simbolo']) || !validar_SimboloMoneda($carritostorage[$i]['simbolo'])) {
            http_response_code(409); //codigo de conflicto
            // Log this as a warning and keep an eye on these attempts
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Simbolo No Valido';
            echo json_encode($resultado);
            return;
        }
    }

    /*
    for ($i = 0; $i < count($carritostorage); $i++) { //validamos el stock en cada producto para validar que este disponible 
        $cantidad = $carritostorage[$i]['cantidad'];
        $id_producto = $carritostorage[$i]['id'];
        $precio = $carritostorage[$i]['precio'];
        $nombre = $carritostorage[$i]['nombre'];
        $simbolo = $carritostorage[$i]['simbolo'];
        $consulta = "
        SELECT
            stock.idProducto, 
            stock.cantidad
        FROM
            stock
        where
            IdProducto ='$id_producto' ";


        //consulta para obtener los resultados segun la pagina 
        $resultado = mysqli_query($conexion, $consulta);
        $newid = "";
        if ($resultado) {
            $data = mysqli_fetch_assoc($resultado);

            // Check if there is enough stock for the requested quantity
            if ($data['cantidad'] <= $cantidad) {
                http_response_code(409); //codigo de conflicto
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'No hay Suficiente Stock';
                echo json_encode($resultado);
                return  $resultado;
            }
        } else {
            http_response_code(409); //codigo de conflicto
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Error Interno';
            echo json_encode($resultado);
            return  $resultado;
        }
    }

    */
    if (!isset($_SESSION['usuario'])) {
        $datavalided =  obtenerid_token($_DataPOST, $carritostorage);
    } else {
        $datavalided =  obtenerid($_DataPOST, $carritostorage);
    }

    $newid = "";
    if ($datavalided->result == true) {
        $newid = $datavalided->data;

        $datavalided2 = agregardetalle($newid, $_DataPOST, $carritostorage, $check_correo, $correo);
        http_response_code(200); //listo
        return;
    }
}
