<?php

header('Content-Type: application/json; charset=utf-8');
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
                    t3.descripcion,
                    t4.nombre AS categoria,
                    moneda_ref.simbolo 
                FROM
                    productos AS t1
                    INNER JOIN (
                    SELECT
                        c4.id_grupo 
                    FROM
                        productos AS c1
                        INNER JOIN moneda_ref AS c2 ON c2.cod_moneda = c1.moneda
                        INNER JOIN stock AS c3 ON c1.id = c3.idProducto
                        INNER JOIN productos_agrupados AS c4 ON c4.id_grupo = c1.id_grupo 
                    WHERE
                        c4.id_grupo LIKE '%$id_agrupado%' 
                    GROUP BY
                        c4.nombre 
                    ORDER BY
                        c1.precio ASC 
                        LIMIT 0,
                        50 
                    ) AS t2 ON t2.id_grupo = t1.id_grupo
                    INNER JOIN productos_agrupados AS t3 ON t3.id_grupo = t1.id_grupo
                    INNER JOIN categorias AS t4 ON t3.categoria = t4.id 
                    INNER JOIN moneda_ref ON t1.moneda = moneda_ref.cod_moneda 
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
    case 'POST':
        include '../../php/FuncionesGenerales.php';
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
                if ($_POST['_method'] == "PUT") {

                    if (isset($_POST['data']['ModalEditar_agrupadosdescripcionProducto']) && validar_string($_POST['data']['ModalEditar_agrupadosdescripcionProducto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $caracteristica1 = $_POST['data']['ModalEditar_agrupadosdescripcionProducto'];
                        $caracteristica1 = eliminar_palabras_sql($caracteristica1);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Descripcion 1 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['ModalEditar_agrupadosdescripcionProducto2']) && validar_string($_POST['data']['ModalEditar_agrupadosdescripcionProducto2'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $caracteristica2 = $_POST['data']['ModalEditar_agrupadosdescripcionProducto2'];
                        $caracteristica2 = eliminar_palabras_sql($caracteristica2);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Descripcion 2 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['ModalEditar_agrupadosdescripcionProducto3']) && validar_string($_POST['data']['ModalEditar_agrupadosdescripcionProducto3'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $caracteristica3 = $_POST['data']['ModalEditar_agrupadosdescripcionProducto3'];
                        $caracteristica3 = eliminar_palabras_sql($caracteristica3);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Descripcion 3 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['ModalEditar_agrupadosdescripcionProducto4']) && validar_string($_POST['data']['ModalEditar_agrupadosdescripcionProducto4'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $caracteristica4 = $_POST['data']['ModalEditar_agrupadosdescripcionProducto4'];
                        $caracteristica4 = eliminar_palabras_sql($caracteristica4);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Descripcion 4 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['data']['ModalEditar_agrupadosdescripcionProducto5']) && validar_string($_POST['data']['ModalEditar_agrupadosdescripcionProducto5'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $caracteristica5 = $_POST['data']['ModalEditar_agrupadosdescripcionProducto5'];
                        $caracteristica5 = eliminar_palabras_sql($caracteristica5);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Descripcion 5 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['data']['ModalEditar_agrupadosID']) && validar_string($_POST['data']['ModalEditar_agrupadosID'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $id_agrupado = $_POST['data']['ModalEditar_agrupadosdescripcionProducto5'];
                        $id_agrupado = eliminar_palabras_sql($id_agrupado);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro no Valido';
                        echo json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['data']['ModalEditar_agrupadosMoneda']) &&  validar_int($_POST['data']['ModalEditar_agrupadosMoneda'])) {
                        $cod_moneda = $_POST['data']['ModalEditar_agrupadosMoneda'];
                        $cod_moneda = eliminar_palabras_sql($cod_moneda);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro No valido';
                        echo json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['data']['ModalEditar_id_producto']) && validar_string($_POST['data']['ModalEditar_id_producto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $id_producto = $_POST['data']['ModalEditar_id_producto'];
                        $id_producto = eliminar_palabras_sql($id_producto);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Parametro no Valido';
                        echo json_encode($resultado);
                        break;
                    }

                    $id_admin = $_SESSION['Usuario']['id'];
                    $consulta = "CALL adm_editar_producto_agupado('$id_agrupado','$id_producto','$caracteristica1','$caracteristica2','$caracteristica3','$caracteristica4','$caracteristica5','$cod_moneda','$id_admin')";
                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado) {
                        $data = mysqli_fetch_assoc($resultado);

                        if ($data['status'] == 1) {
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];
                            $resultado->data =  array(
                                "status" => $data['status']
                            );
                            echo  json_encode($resultado);
                            break;
                        } else {
                            http_response_code(409); //codigo de conflicto
                            // Log this as a warning and keep an eye on these attempts
                            $resultado = new stdClass();
                            $resultado->result = FALSE;
                            $resultado->icono = "error";
                            $resultado->titulo = "Error!";
                            $resultado->mensaje = $data['msg'];
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
                        $resultado->mensaje = 'Error Interno';
                        echo json_encode($resultado);
                        break;
                    }
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
        break;
}
