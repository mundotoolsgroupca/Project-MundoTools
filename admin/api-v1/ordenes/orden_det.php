<?php

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
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



                if (isset($_POST['id']) && validar_string($_POST['id'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
                    $id = eliminar_palabras_sql($id);
                } else {
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'ID no Valido';
                    echo json_encode($resultado);
                    break;
                }




                include_once '../../php/conexion.php';
                // Configurar los encabezados de la respuesta
                header('Content-Type: application/json');
                $consulta = "
                SELECT
                productos.precio,
                ordenes_det.cantidad,
                ordenes.nombreempresa,
                ordenes.numerotelefono,
                ordenes_det.precio,
                ordenes_det.producto_id,
                ordenes.responsable,
                moneda_ref.simbolo,
                DATE_FORMAT( ordenes.fecha, '%Y-%m-%d' ) AS fecha,
                DATE_FORMAT( ordenes.fecha, '%h:%i %p' ) AS hora 
            FROM
                ordenes
                INNER JOIN ordenes_det ON ordenes.id = ordenes_det.orden_id
                INNER JOIN productos ON ordenes_det.producto_id = productos.id
                INNER JOIN moneda_ref ON ordenes.moneda = moneda_ref.cod_moneda 
            WHERE 
            ordenes.id = $id; ";

                $resultado = mysqli_query($conexion, $consulta);
                $data = [];
                while ($row = mysqli_fetch_assoc($resultado)) {

                    array_push($data, [
                        "cantidad" => $row['cantidad'],
                        "nombreempresa" => $row['nombreempresa'],
                        "nombre" => $row['nombre'],
                        "numerotelefono" => $row['numerotelefono'],
                        "precio" => str_replace(',', '.', number_format((float)$row['precio'], 2, ',', '')),
                        "producto_id" => $row['producto_id'],
                        "responsable" => $row['responsable'],
                        "simbolo" => $row['simbolo'],
                        "fecha" => $row['fecha'],
                        "hora" => $row['hora'],
                    ]);
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
}
