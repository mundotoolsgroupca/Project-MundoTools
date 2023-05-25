<?php
/* 

Si el formato no es válido o el DateTimeobjeto resultante es false, eso significa que la fecha no es válida. Luego puede validar aún más la fecha si es necesario, como verificar si se encuentra dentro de un cierto rango.

Tenga en cuenta que la $dateFormatvariable debe coincidir con el formato de la cadena de fecha que está tratando de validar. Si el formato de la entrada de fecha varía, es posible que deba usar un formato más indulgente o múltiples formatos para manejar todas las entradas posibles.


*/
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
}
