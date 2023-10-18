<?php

header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];



switch ($method) {
    case 'GET':
        include_once '../../php/FuncionesGenerales.php';
        include_once '../../php/conexion.php';
        $http = getallheaders();
        session_name("ecomercer_admin_data");
        session_start();
        if (!empty($http['x-csrf-token'])) {

            if (!isset($_SESSION['token'])) {
                // Log this as a warning and keep an eye on these attempts
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Parametro no Valido';
                echo json_encode($resultado);
                return;
            }


            if (hash_equals($_SESSION['token'], $http['x-csrf-token'])) {

                $consulta = "
                SELECT
                c1.id, 
                categorias.nombre as categoria, 
                c1.precio, 
                c1.precio2, 
                c3.cantidad, 
                c2.nombre, 
                c1.id_grupo
            FROM
                productos AS c1
                INNER JOIN
                productos_agrupados AS c2
                ON 
                    c1.id_grupo = c2.id_grupo
                INNER JOIN
                categorias
                ON 
                    c2.categoria = categorias.id
                INNER JOIN
                stock AS c3
                ON 
                    c1.id = c3.idProducto";

                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado) {
                    $data = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push(
                            $data,
                            [
                                "id" => $row['id'],
                                "categoria" =>  $row['categoria'],
                                "precio" => number_format($row['precio'], 2),
                                "precio2" => number_format($row['precio2'], 2),
                                "stock" =>  $row['cantidad'],
                                "nombre" =>  $row['nombre'],
                                "id_grupo" =>  $row['id_grupo'],

                            ]
                        );
                    }

                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "";
                    $resultado->data = $data;

                    echo  json_encode($resultado);
                    return;
                } else {
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
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'El token no fue enviado en el formulario';
            echo json_encode($resultado);
            return;
        }

        break;
}
