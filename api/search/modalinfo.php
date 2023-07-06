<?php

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $http = getallheaders();
        session_name("ecomercer_user_data");
        session_start();


        if (!empty($http['X-Csrf-Token'])) {

            if (!isset($_SESSION['token'])) {
                http_response_code(409); //codigo de conflicto
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
                if (isset($_GET['id_grupo']) && validar_string($_POST['id_grupo'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                    $id_grupo = htmlspecialchars($_GET['id_grupo'], ENT_QUOTES, 'UTF-8');
                    $id_grupo = eliminar_palabras_sql($id_grupo);
                } else {
                    http_response_code(409); //codigo de conflicto
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro no Valido';
                    echo json_encode($resultado);
                    return;
                }

                include_once '../../php/conexion.php';

                $consulta = "

                    SELECT
                        t1.*,
                        t3.nombre,
                        t3.descripcion,
                        t2.simbolo,
                        t2.imagen,
                        stock.cantidad AS stock 
                    FROM
                        productos AS t1
                        INNER JOIN (
                        SELECT
                            c4.id_grupo,
                            c2.simbolo,
                            c4.imagen 
                        FROM
                            productos_agrupados AS c4
                            INNER JOIN productos AS c1 ON c1.id = c4.id_grupo
                            INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda 
                        WHERE
                            c4.id_grupo = '$id_grupo' 
                        ) AS t2 ON t2.id_grupo = t1.id_grupo
                        INNER JOIN productos_agrupados AS t3 ON t3.id_grupo = t1.id_grupo
                        INNER JOIN stock ON t1.id = stock.idProducto 
                    ORDER BY
                        t1.id ASC 
                    ";




                $resultado2 = mysqli_query($conexion, $consulta);
                $json = [];
                while ($row2 = mysqli_fetch_assoc($resultado2)) {
                    $precio2 = number_format($row2['precio2'], 2);
                    $precio = number_format($row2['precio'], 2);
                    $row2['precio'] = $precio;
                    $row2['precio2'] = $precio2;
                    $row2['descripcion'] = str_replace('•', '<br>', $row2['descripcion']);
                    array_push($json, $row2);
                }

                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado) {

                    http_response_code(200); //sucess
                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "";
                    $resultado->data = $json;
                    echo  json_encode($resultado);
                    break;
                } else {
                    http_response_code(409); //codigo de conflicto
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
