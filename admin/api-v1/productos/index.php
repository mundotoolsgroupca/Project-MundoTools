<?php

header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];



switch ($method) {
    case 'GET':

        include_once '../../php/FuncionesGenerales.php';
        if (!isset($_GET['_method'])) {

            include_once '../../php/conexion.php';
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
                    $resultado->mensaje = 'Parametro no Valido';
                    echo json_encode($resultado);
                    return;
                }


                if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {
                    $consulta = "
                        SELECT
                        c1.id_grupo,
                        c1.nombre,
                        c1.descripcion,
                        c1.categoria as categoria_id,
                        c1.imagen,
                        c2.nombre as nombre_categoria
                    FROM
                        productos_agrupados AS c1
                        INNER JOIN categorias AS c2 ON c1.categoria = c2.id  ";


                    $resultado = mysqli_query($conexion, $consulta);
                    $data = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push(
                            $data,
                            [
                                "id_grupo" => $row['id_grupo'],
                                "nombre" =>  $row['nombre'],
                                "descripcion" => $row['descripcion'],
                                "nombre_categoria" =>  $row['nombre_categoria'],
                                "categoria_id" =>  $row['categoria_id'],
                                "imagen" =>  $row['imagen'],

                            ]
                        );
                    }

                    http_response_code(200);
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
        } elseif ($_GET['_method'] == "DELETE") {
            include_once '../../php/conexion.php';
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
                    $resultado->mensaje = 'Parametro no Valido';
                    echo json_encode($resultado);
                    return;
                }


                if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {

                    if (isset($_GET['id']) && validar_string($_GET['id'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $id = $_GET['id'];
                        $id = eliminar_palabras_sql($id);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        // Log this as a warning and keep an eye on these attempts
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'id no Valido';
                        echo json_encode($resultado);
                        return;
                    }
                    /*
                    $consulta = "select imagen from productos_agrupados where id = '$id' ";
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);
*/

                    $consulta = "CALL adm_eliminar_producto('$id','" . $_SESSION['Usuario']['id'] . "')"; //eliminar Producto
                    $resultado = mysqli_query($conexion, $consulta);
                    $datadeleted = mysqli_fetch_assoc($resultado);

                    if ($resultado) { //* si ejecuto la consulta sin errores
                        if ($datadeleted['status'] == 1) { //* si lo elimino
                            /*
                            $url_img = $data['imagen'];
                            foreach (glob(dirname(__FILE__, 4) . "/$url_img") as $nombre_fichero) {
                                unlink(dirname(__FILE__, 4) . "/$url_img"); //se elimina la  Imagen 
                            }
*/
                            http_response_code(200); //codigo de relializado
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $datadeleted['msg'];
                            $resultado->data =  array(
                                "status" => $datadeleted['status'],
                                "msg" => $datadeleted['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        } elseif ($datadeleted['status'] == 0 && $datadeleted['afectados'] == 0) { //!si no lo hizo 
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $datadeleted['msg'];
                            $resultado->data =   array(
                                "status" => $datadeleted['status'],
                                "msg" => $datadeleted['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        }
                    } else { //!si hubo un error
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = TRUE;
                        $resultado->icono = "success";
                        $resultado->titulo = "";
                        $resultado->mensaje = "";
                        $resultado->data = array(
                            "status" => 0,
                            "msg" => "Error Interno"
                        );
                        echo  json_encode($resultado);
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
        }
        break;
    case 'POST':

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

                if (!isset($_SESSION['Usuario'])) {
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    return;
                }



                if (!isset($_POST['_method'])) {


                    if (isset($_POST['ModalAgregar_agrupadosidproducto']) != false && validar_string($_POST['ModalAgregar_agrupadosidproducto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $ModalAgregar_agrupadosidproducto = $_POST['ModalAgregar_agrupadosidproducto'];
                        $ModalAgregar_agrupadosidproducto = eliminar_palabras_sql($ModalAgregar_agrupadosidproducto);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Id Producto No Valido";
                        echo  json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['ModalAgregar_agrupadosID']) != false && validar_string($_POST['ModalAgregar_agrupadosID'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $ModalAgregar_agrupadosID = $_POST['ModalAgregar_agrupadosID'];
                        $ModalAgregar_agrupadosID = eliminar_palabras_sql($ModalAgregar_agrupadosID);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Id Grupo no Valido No Valido";
                        echo  json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['ModalAgregar_agrupadosprecio']) && validar_Monto($_POST['ModalAgregar_agrupadosprecio'])) {
                        $ModalAgregar_agrupadosprecio = $_POST['ModalAgregar_agrupadosprecio'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Precio No Valido";
                        echo  json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['ModalAgregar_agrupadosStock']) && validar_int($_POST['ModalAgregar_agrupadosStock']) && $_POST['ModalAgregar_agrupadosStock'] > 0) {
                        $ModalAgregar_agrupadosStock = $_POST['ModalAgregar_agrupadosStock'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Stock del Producto No Valido";
                        echo  json_encode($resultado);
                        break;
                    }




                    if (isset($_POST['ModalAgregar_agrupadoscaracteristicaProducto']) && validar_string($_POST['ModalAgregar_agrupadoscaracteristicaProducto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/: ')) {
                        $ModalAgregar_agrupadoscaracteristicaProducto = $_POST['ModalAgregar_agrupadoscaracteristicaProducto'];
                        $ModalAgregar_agrupadoscaracteristicaProducto = eliminar_palabras_sql($ModalAgregar_agrupadoscaracteristicaProducto);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Caracteristica 1 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['ModalAgregar_agrupadoscaracteristicaProducto2']) && validar_string($_POST['ModalAgregar_agrupadoscaracteristicaProducto2'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/: ')) {
                        $ModalAgregar_agrupadoscaracteristicaProducto2 = $_POST['ModalAgregar_agrupadoscaracteristicaProducto2'];
                        $ModalAgregar_agrupadoscaracteristicaProducto2 = eliminar_palabras_sql($ModalAgregar_agrupadoscaracteristicaProducto2);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Caracteristica 2 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['ModalAgregar_agrupadoscaracteristicaProducto3']) && validar_string($_POST['ModalAgregar_agrupadoscaracteristicaProducto3'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/: ')) {
                        $ModalAgregar_agrupadoscaracteristicaProducto3 = $_POST['ModalAgregar_agrupadoscaracteristicaProducto3'];
                        $ModalAgregar_agrupadoscaracteristicaProducto3 = eliminar_palabras_sql($ModalAgregar_agrupadoscaracteristicaProducto3);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Caracteristica 3 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['ModalAgregar_agrupadoscaracteristicaProducto4']) && validar_string($_POST['ModalAgregar_agrupadoscaracteristicaProducto4'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/: ')) {
                        $ModalAgregar_agrupadoscaracteristicaProducto4 = $_POST['ModalAgregar_agrupadoscaracteristicaProducto4'];
                        $ModalAgregar_agrupadoscaracteristicaProducto4 = eliminar_palabras_sql($ModalAgregar_agrupadoscaracteristicaProducto4);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Caracteristica 4 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['ModalAgregar_agrupadoscaracteristicaProducto5']) && validar_string($_POST['ModalAgregar_agrupadoscaracteristicaProducto5'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/: ')) {
                        $ModalAgregar_agrupadoscaracteristicaProducto5 = $_POST['ModalAgregar_agrupadoscaracteristicaProducto5'];
                        $ModalAgregar_agrupadoscaracteristicaProducto5 = eliminar_palabras_sql($ModalAgregar_agrupadoscaracteristicaProducto5);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Caracteristica 5 Contiene Caracteres no Permitidos';
                        echo json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['ModalAgregar_agrupadosMoneda'])  && validar_int($_POST['ModalAgregar_agrupadosMoneda'])) {
                        $ModalAgregar_agrupadosMoneda = $_POST['ModalAgregar_agrupadosMoneda'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "moneda del Producto No Valida";
                        echo  json_encode($resultado);
                        break;
                    }
                    $consulta = "CALL adm_agregar_producto('$ModalAgregar_agrupadosidproducto','$ModalAgregar_agrupadosID','$ModalAgregar_agrupadosprecio','$ModalAgregar_agrupadosStock','$ModalAgregar_agrupadoscaracteristicaProducto','$ModalAgregar_agrupadoscaracteristicaProducto2','$ModalAgregar_agrupadoscaracteristicaProducto3','$ModalAgregar_agrupadoscaracteristicaProducto4','$ModalAgregar_agrupadoscaracteristicaProducto5','$ModalAgregar_agrupadosMoneda','" . $_SESSION['Usuario']['id'] . "')";



                    /* $consulta = " 
                    CALL adm_agregar_producto('$idproducto','$id_grupo','$nombreproducto','$precio', '$stock','$categoria', '$descripcion','$url_img_guardar','$moneda','$caracteristica1','$caracteristica2','$caracteristica3','$caracteristica4','$caracteristica5','" . $_SESSION['Usuario']['id'] . "'); "; //[nombre][precio][stock][categoria][descripcion][imagen] 
                    //asi la ejecuta phpmyadmin*/


                    include_once '../../php/conexion.php';
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);
                    if ($resultado) { //* si realizo la consulta 
                        if ($data['status'] == 1) {  //* si guardo el producto

                            http_response_code(200);
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];
                            $resultado->data =  array(
                                "status" => $data['status'],
                                "msg" => $data['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        } elseif ($data['status'] == 0) { //! si no lo guardo 
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = false;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $data['msg'];
                            $resultado->data =  array(
                                "status" => $data['status'],
                                "msg" => $data['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        }
                    } else { //! si hubo un error
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "success";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Error Interno";
                        echo  json_encode($resultado);
                        break;
                    }
                    break;
                }


                if ($_POST['_method'] == "PUT") {

                    if (isset($_POST['validar']) &&  $_POST['validar'] == 1) {



                        $stock = isset($_POST['newdata']['stock']) ? $_POST['newdata']['stock'] : false;
                        if ($stock != false) {
                            if (validar_int($_POST['newdata']['stock'])) {
                                $stock = $_POST['newdata']['stock'];
                            } else {
                                http_response_code(409); //codigo de conflicto
                                $resultado = new stdClass();
                                $resultado->result = false;
                                $resultado->icono = "";
                                $resultado->titulo = "";
                                $resultado->mensaje = "Stock del Producto No Valido";
                                echo  json_encode($resultado);
                                break;
                            }
                        }
                        $precio = isset($_POST['newdata']['precio']) ? $_POST['newdata']['precio'] : false;
                        if ($precio != false) {
                            if (validar_Monto($_POST['newdata']['precio'])) {
                                $precio = $_POST['newdata']['precio'];
                            } else {
                                http_response_code(409); //codigo de conflicto
                                $resultado = new stdClass();
                                $resultado->result = false;
                                $resultado->icono = "";
                                $resultado->titulo = "";
                                $resultado->mensaje = "Precio No Valido";
                                echo  json_encode($resultado);
                                break;
                            }
                        }



                        include_once "../../php/conexion.php";

                        if (isset($_POST['newdata']['id']) && validar_string($_POST['newdata']['id'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                            $id = $_POST['newdata']['id'];
                        } else {
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = false;
                            $resultado->icono = "";
                            $resultado->titulo = "";
                            $resultado->mensaje = "Id no Valido";
                            echo  json_encode($resultado);
                            break;
                        }
                        if (isset($_POST['newdata']['id_grupo']) && validar_string($_POST['newdata']['id'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                            $id_grupo = $_POST['newdata']['id_grupo'];
                        } else {
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = false;
                            $resultado->icono = "";
                            $resultado->titulo = "";
                            $resultado->mensaje = "Id Grupo no Valido";
                            echo  json_encode($resultado);
                            break;
                        }

                        if ($precio != false) {
                            $consulta = "CALL adm_editar_producto( '$id_grupo', '$id', '0', '0', '0','0','0','0','$precio','0','" . $_SESSION['Usuario']['id'] . "','1')"; //editar el stock
                        } else if ($stock != false) {
                            $consulta = "CALL adm_editar_producto( '$id_grupo', '$id', '0', '0', '0','0','0','0','0','$stock','" . $_SESSION['Usuario']['id'] . "','2')"; //editar el stock
                        }



                        $resultado = mysqli_query($conexion, $consulta);

                        $dataquery = mysqli_fetch_assoc($resultado);
                        if ($resultado) { //* si realizo la consulta sin problemas

                            if ($dataquery['status'] == 1) {
                                http_response_code(200);
                                $resultado = new stdClass();
                                $resultado->result = TRUE;
                                $resultado->icono = "success";
                                $resultado->titulo = "";
                                $resultado->mensaje = $dataquery['msg'];
                                $resultado->data = array(
                                    "status" => $dataquery['status'],
                                    "msg" => $dataquery['msg']
                                );
                                echo  json_encode($resultado);
                                break;
                            } elseif ($dataquery['status'] == 0) {
                                http_response_code(409); //codigo de conflicto
                                $resultado = new stdClass();
                                $resultado->result = TRUE;
                                $resultado->icono = "success";
                                $resultado->titulo = "";
                                $resultado->mensaje = $dataquery['msg'];
                                $resultado->data = array(
                                    "status" => $dataquery['status'],
                                    "msg" => $dataquery['msg']
                                );
                                echo  json_encode($resultado);
                                break;
                            }
                        } else { //! si hubo un fallo 
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = false;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = "Error Interno";
                            echo  json_encode($resultado);
                            break;
                        }

                        break;
                    }


                    if (isset($_POST['ModalEditarID_grupo']) != false && validar_string($_POST['ModalEditarID_grupo'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $ModalEditarID_grupo = $_POST['ModalEditarID_grupo'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "ID Grupo No Valida";
                        echo  json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['ModalEditarNombreProducto']) != false && $_POST['ModalEditarNombreProducto'] != "") {
                        $ModalEditarNombreProducto = $_POST['ModalEditarNombreProducto'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Nombre del Producto No Valido";
                        echo  json_encode($resultado);
                        break;
                    }



                    if (isset($_POST['ModalEditarCategoria']) != false && $_POST['ModalEditarCategoria'] != "") {
                        $ModalEditarCategoria = $_POST['ModalEditarCategoria'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Categoria No valida";
                        echo  json_encode($resultado);
                        break;
                    }
                    if (isset($_POST['ModalEditarDescripcion']) != false && $_POST['ModalEditarDescripcion'] != "") {
                        $ModalEditarDescripcion = $_POST['ModalEditarDescripcion'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Descripcion no Valida";
                        echo  json_encode($resultado);
                        break;
                    }
                    /*
                        $ModalEditarID_grupo = "";
                        $ModalEditarNombreProducto = "";
                        $ModalEditarPrecio = "";
                        $ModalEditarMoneda = "";
                        $ModalEditarStock = "";
                        $ModalEditarCategoria = "";
                        $ModalEditarDescripcion = "";
                        */
                    include_once "../../php/conexion.php";
                    //session_name("ecomercer_admin_data");
                    // session_start();
                    $consulta = "CALL adm_editar_grupo( '$ModalEditarID_grupo',  '$ModalEditarNombreProducto', '$ModalEditarDescripcion', '$ModalEditarCategoria','" . $_SESSION['Usuario']['id'] . "')";


                    $resultado = mysqli_query($conexion, $consulta);
                    $dataquery = mysqli_fetch_assoc($resultado);
                    if ($resultado) { //* si realizo la consulta sin problemas

                        if ($dataquery['status'] == 1) {
                            http_response_code(200);
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $dataquery['msg'];
                            $resultado->data =   array(
                                "status" => $dataquery['status'],
                                "msg" => $dataquery['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        } elseif ($dataquery['status'] == 0) {
                            http_response_code(409); //codigo de conflicto 
                            $resultado = new stdClass();
                            $resultado->result = TRUE;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $dataquery['msg'];
                            $resultado->data =   array(
                                "status" => $dataquery['status'],
                                "msg" => $dataquery['msg']
                            );
                            echo  json_encode($resultado);
                            break;
                        }
                    } else { //! si hubo un fallo 
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "success";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Error Interno";
                        echo  json_encode($resultado);
                        break;
                    }
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
