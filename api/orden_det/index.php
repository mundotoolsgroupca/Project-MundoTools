<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

        session_name("ecomercer_user_data");
        session_start();
        $http = getallheaders();
        if (!empty($http['X-Csrf-Token'] )) {

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

            if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'] )) {
                include_once '../../php/FuncionesGenerales.php';

                if (isset($_GET['orden_id']) && validar_int($_GET['orden_id'])) {
                    $orden_id = $_GET['orden_id'];
                    $orden_id = eliminar_palabras_sql($orden_id);
                } else {
                    http_response_code(409); //codigo de conflicto
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'orden No Valido';
                    echo json_encode($resultado);
                    return  $resultado;
                }




                $id_vendedor = $_SESSION['usuario']['id'];
                include_once '../../php/conexion.php';
                $consulta = "
                SELECT
                    productos.nombre, 
                    ordenes_det.cantidad, 
                    ordenes_det.precio
                FROM
                    ordenes_det
                INNER JOIN
                    ordenes
                ON 
                    ordenes_det.orden_id = ordenes.id
                INNER JOIN
                    productos
                ON 
                    ordenes_det.producto_id = productos.id
                INNER JOIN
                    vendedores
                ON 
                    ordenes.id_vendedor = vendedores.id
                WHERE
                    ordenes_det.orden_id = '$orden_id'
                and
                    ordenes.id_vendedor = '$id_vendedor'
                ";
                $data = [];
                $resultado = mysqli_query($conexion, $consulta);

                if ($resultado) {
                    while ($row = mysqli_fetch_assoc($resultado)) {


                        array_push($data, [
                            "nombre" => $row['nombre'],
                            "cantidad" => $row['cantidad'],
                            "precio" => number_format($row['precio'], 2)
                        ]);
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
        //break;
}
