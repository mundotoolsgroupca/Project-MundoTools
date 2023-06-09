<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

        if (isset($_GET['categoria'])) {

            if (isset($_GET['coleccion'])) {

                if ($_GET['coleccion'] == 1) {



                    include_once '../../php/conexion.php';
                    // Configurar los encabezados de la respuesta

                    $consulta = "
                    SELECT 
                    c.nombre as categoria,
                    c.id as id,
                    CONCAT (
                        '{ \"productos\" : [',
                        GROUP_CONCAT(
                            JSON_OBJECT(
                            'id', p.id,
                            'nombre', p.nombre,
                            'descripcion', p.descripcion,
                            'imagen', p.imagen,
                            'categoria', p.categoria,
                            'precio', p.precio,
                            'moneda', p.moneda
                            )
                            ORDER BY p.id LIMIT 9
                        ),
                        ']}'
                    ) as datos_categoria
                    FROM productos p
                    JOIN categorias c ON p.categoria = c.id
                    GROUP BY c.nombre";


                    $resultado = mysqli_query($conexion, $consulta);
                    $data = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push($data, $row);
                    }

                    http_response_code(200); //codigo de conflicto
                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "";
                    $resultado->data = $data;

                    echo  json_encode($resultado);
                    break;
                }


                http_response_code(409); //codigo de conflicto
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'Coleccion invalida';
                echo json_encode($resultado);
                break;
            }

            http_response_code(409); //codigo de conflicto
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Parametro No Valido';
            echo json_encode($resultado);
            break;
        }


        break;
}
