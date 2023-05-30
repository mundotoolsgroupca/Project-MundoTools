<?php

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

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

                include_once '../../php/FuncionesGenerales.php';
                if (isset($_GET['id_agrupado']) && validar_string($_GET['id_agrupado'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                    $id_agrupado = $_GET['id_agrupado'];
                    $id_agrupado = eliminar_palabras_sql($id_agrupado);
                } else {
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Id Agrupado No Valido';
                    echo json_encode($resultado);
                    return;
                }



                include_once '../../php/conexion.php';
                $consulta = "
                SELECT
                    t1.*,
                    t3.nombre,
                    t3.descripcion 
                FROM
                    productos t1
                    INNER JOIN (
                    SELECT
                        c4.id_grupo 
                    FROM
                        productos AS c1
                        INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda
                        INNER JOIN stock AS c3 ON c1.id = c3.idProducto
                        INNER JOIN productos_agrupados c4 ON c4.id_grupo = c1.id_grupo 
                    WHERE
                        c4.id_grupo LIKE '%$id_agrupado%' 
                    GROUP BY
                        c4.nombre 
                    ORDER BY
                        c1.precio ASC 
                        LIMIT 50 OFFSET 0 
                    ) t2 ON t2.id_grupo = t1.id_grupo
                    INNER JOIN productos_agrupados t3 ON t3.id_grupo = t1.id_grupo 
                ORDER BY
                    t1.id ASC";
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
}
