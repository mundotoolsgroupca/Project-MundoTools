<?php

header('Content-Type: application/json; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (!isset($_GET['_method'])) {
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


                    if (isset($_GET['id_agrupado']) && validar_string($_GET['id_agrupado'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/: ')) {
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

                    if (isset($_GET['id_grupo']) && validar_string($_GET['id_grupo'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $id_grupo = $_GET['id_grupo'];
                        $id_grupo = eliminar_palabras_sql($id_grupo);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        // Log this as a warning and keep an eye on these attempts
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id Grupo no Valido';
                        echo json_encode($resultado);
                        return;
                    }
                    /*
                    $consulta = "select imagen from productos_agrupados where id = '$id' ";
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);
*/

                    $consulta = "CALL adm_eliminar_agrupado('$id_grupo','" . $_SESSION['Usuario']['id'] . "')"; //eliminar Producto
                    $resultado = mysqli_query($conexion, $consulta);
                    $datadeleted = mysqli_fetch_assoc($resultado);

                    if ($resultado) { //* si ejecuto la consulta sin errores
                        if ($datadeleted['status'] == 1) { //* si lo elimino

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
                        } else { //!si no lo hizo 
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = false;
                            $resultado->icono = "success";
                            $resultado->titulo = "";
                            $resultado->mensaje = $datadeleted['msg'];
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
                if (!isset($_POST['_method'])) {


                    if (isset($_POST['id_grupo']) != false && validar_string($_POST['id_grupo'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $id_grupo = $_POST['id_grupo'];
                        $id_grupo = eliminar_palabras_sql($id_grupo);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Id Grupo No Valido";
                        echo  json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['nombreGrupo']) && validar_string($_POST['nombreGrupo'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&,:• ')) {
                        $nombreGrupo = $_POST['nombreGrupo'];
                        $nombreGrupo = eliminar_palabras_sql($nombreGrupo);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Nombre del Grupo";
                        echo  json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['descripcion']) && $_POST['descripcion'] != "") {
                        $descripcion = $_POST['descripcion'];
                        $descripcion = eliminar_palabras_sql($descripcion);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Descripcion No Valida";
                        echo  json_encode($resultado);
                        break;
                    }


                    if (isset($_POST['categoria']) && validar_int($_POST['categoria'])) {
                        $categoria = $_POST['categoria'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Categoria del Producto No Valida";
                        echo  json_encode($resultado);
                        break;
                    }

                    $img_nombre = $_FILES['imagen']['name'];
                    $img_size = $_FILES['imagen']['size'];
                    $img_tmp = $_FILES['imagen']['tmp_name'];
                    $error = $_FILES['imagen']['error'];

                    if ($error === 0) {
                        if ($img_size > 5242880) { // tamaño máximo en bytes (5 MB)
                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = false;
                            $resultado->icono = "";
                            $resultado->titulo = "";
                            $resultado->mensaje = "La Imagen supera el Limite de Peso Permitido";
                            echo  json_encode($resultado);
                            break;
                        } else {
                            $img_ex = pathinfo($img_nombre, PATHINFO_EXTENSION); //obtenemos la extencion del archivo
                            $img_ex_lc = strtolower($img_ex); //la colocamos en minuscula
                            $allowed_exs = array("jpg", "jpeg", "png", "webp"); //formatos de archivos permitidos


                            if (in_array($img_ex_lc, $allowed_exs)) { //validamos que el formato sea de los permitidos
                                $new_img_name = $id_grupo . '.' . $img_ex_lc; //creamos un nombre unico
                                // $img_upload_path = 'assets/uploads/' . $new_img_name; //ubicamos la carpeta donde se guardara
                                $img_upload_path = dirname(__FILE__, 4) . "/assets/uploads/" . $new_img_name; //ubicamos la carpeta donde se guardara
                                move_uploaded_file($img_tmp, $img_upload_path); //guardamos el archivo


                                include_once "../../php/conexion.php";
                                $url_img_guardar = "/assets/uploads/$new_img_name"; //dirrecion donde estara almacenada la imagen

                                $consulta = "CALL adm_agregar_agrupado('$id_grupo','$nombreGrupo','$categoria','$url_img_guardar','$descripcion');";
                                $resultado = mysqli_query($conexion, $consulta);
                                $data = mysqli_fetch_assoc($resultado);
                                if ($resultado) { //* si realizo la consulta 
                                    if ($data['status'] == 1) {  //* si guardo el producto
                                        move_uploaded_file($img_tmp, $img_upload_path); //guardamos el archivo
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
                            } else {
                                http_response_code(409); //codigo de conflicto
                                $resultado = new stdClass();
                                $resultado->result = false;
                                $resultado->icono = "";
                                $resultado->titulo = "";
                                $resultado->mensaje = "Formato de la Imagen no Valida";
                                echo  json_encode($resultado);
                            }
                        }
                    }
                } elseif ($_POST['_method'] == "PUT") {

                    $formDataString = $_POST['data'];
                    $formDataArray = array();
                    parse_str($formDataString, $formDataArray);
                    $_POST['data'] = $formDataArray;



                    if (isset($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto']) && validar_string($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/:,• ')) {
                        $caracteristica1 = $_POST['data']['ModalEditar_agrupadoscaracteristicaProducto'];
                        $caracteristica1 = eliminar_palabras_sql($caracteristica1);
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
                    if (isset($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto2']) && validar_string($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto2'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/:,• ')) {
                        $caracteristica2 = $_POST['data']['ModalEditar_agrupadoscaracteristicaProducto2'];
                        $caracteristica2 = eliminar_palabras_sql($caracteristica2);
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
                    if (isset($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto3']) && validar_string($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto3'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/:,• ')) {
                        $caracteristica3 = $_POST['data']['ModalEditar_agrupadoscaracteristicaProducto3'];
                        $caracteristica3 = eliminar_palabras_sql($caracteristica3);
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
                    if (isset($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto4']) && validar_string($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto4'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/:,• ')) {
                        $caracteristica4 = $_POST['data']['ModalEditar_agrupadoscaracteristicaProducto4'];
                        $caracteristica4 = eliminar_palabras_sql($caracteristica4);
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
                    if (isset($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto5']) && validar_string($_POST['data']['ModalEditar_agrupadoscaracteristicaProducto5'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&/:,• ')) {
                        $caracteristica5 = $_POST['data']['ModalEditar_agrupadoscaracteristicaProducto5'];
                        $caracteristica5 = eliminar_palabras_sql($caracteristica5);
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


                    if (isset($_POST['data']['ModalEditar_agrupadosID']) && validar_string($_POST['data']['ModalEditar_agrupadosID'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$&,• ')) {
                        $id_agrupado = $_POST['data']['ModalEditar_agrupadosID'];
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
                    include '../../php/conexion.php';
                    $consulta = "CALL adm_editar_producto('$id_agrupado','$id_producto','$caracteristica1','$caracteristica2','$caracteristica3','$caracteristica4','$caracteristica5','$cod_moneda','0','0','0','$id_admin','0')";
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
