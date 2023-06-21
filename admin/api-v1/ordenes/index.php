<?php
/* 

Si el formato no es válido o el DateTimeobjeto resultante es false, eso significa que la fecha no es válida. Luego puede validar aún más la fecha si es necesario, como verificar si se encuentra dentro de un cierto rango.

Tenga en cuenta que la $dateFormatvariable debe coincidir con el formato de la cadena de fecha que está tratando de validar. Si el formato de la entrada de fecha varía, es posible que deba usar un formato más indulgente o múltiples formatos para manejar todas las entradas posibles.


*/
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        include_once '../../php/FuncionesGenerales.php';
        session_name("ecomercer_admin_data");
        session_start();
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

                if (isset($_GET['fecha']) && validar_fecha($_GET['fecha'], 'Y-m-d')) {
                    $fecha = $_GET['fecha'];
                } else {

                    http_response_code(409); //error
                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "";
                    $resultado->data = $data;
                    echo  json_encode($resultado);
                    break;
                }

                include_once '../../php/conexion.php';
                // Configurar los encabezados de la respuesta
                header('Content-Type: application/json');
                $consulta = "
                    SELECT
                        id,
                        nombreempresa,
                        responsable,
                        status,
                        numerotelefono,
                        DATE_FORMAT(fecha, '%Y-%m-%d') AS fecha,
                        DATE_FORMAT(fecha, '%h:%i %p') AS hora
                    FROM
                        Ordenes
                    WHERE
                        DATE(fecha) = '$fecha';";
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
    case "POST":
        if (isset($_POST['_method']) && $_POST['_method'] == "PUT") {

            $http = getallheaders();
            session_name("ecomercer_admin_data");
            session_start();
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

                    $nombre_admin =  $_SESSION['Usuario']['nombre'];


                    $id_vendedor = $_SESSION['Usuario']['id'];
                    $consulta = "CALL  adm_cancelar_orden($id_vendedor,$id_orden,'El Admin $nombre_admin Cancelo la Orden Nro $id_orden');";

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
}
