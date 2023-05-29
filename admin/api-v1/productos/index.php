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
            if (!empty($http['X-Csrf-Token'] )) {

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


                if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'] )) {
                    $consulta = "
                    SELECT
                    c1.id,
                    c2.nombre,
                    c4.nombre AS categoria,
                    c2.descripcion,
                    c2.id_grupo,
                    c2.categoria AS categoria_id,
                    c2.imagen,
                    c1.precio,
                    c3.simbolo,
                    c3.cod_moneda,
                    c5.cantidad AS stok 
                FROM
                    productos AS c1
                    INNER JOIN productos_agrupados AS c2 ON c1.id = c2.id_grupo
                    INNER JOIN moneda_ref AS c3 ON c1.moneda = c3.cod_moneda
                    INNER JOIN categorias AS c4 ON c2.categoria = c4.id
                    INNER JOIN stock AS c5 ON c1.id = c5.idProducto";


                    $resultado = mysqli_query($conexion, $consulta);
                    $data = [];
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        array_push(
                            $data,
                            [
                                "id" => $row['id'],
                                "nombre" =>  $row['nombre'],
                                "descripcion" => $row['descripcion'],
                                "categoria_id" =>  $row['categoria_id'],
                                "imagen" =>  $row['imagen'],
                                "precio" =>  number_format($row['precio'], 2),
                                "simbolo" =>  $row['simbolo'],
                                "cod_moneda" =>  $row['cod_moneda'],
                                "categoria" => $row['categoria'],
                                "stock" =>  $row['stock']

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
            if (!empty($http['X-Csrf-Token'] )) {

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


                if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'] )) {

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

                    $consulta = "select * from productos where id = '$id' ";
                    $resultado = mysqli_query($conexion, $consulta);
                    $data = mysqli_fetch_assoc($resultado);


                    $consulta = "CALL adm_eliminar_producto('$id','" . $_SESSION['Usuario']['id'] . "')"; //eliminar Producto
                    $resultado = mysqli_query($conexion, $consulta);
                    $datadeleted = mysqli_fetch_assoc($resultado);

                    if ($resultado) { //* si ejecuto la consulta sin errores
                        if ($datadeleted['status'] == 1) { //* si lo elimino
                            $url_img = $data['imagen'];
                            foreach (glob(dirname(__FILE__, 4) . "/$url_img") as $nombre_fichero) {
                                unlink(dirname(__FILE__, 4) . "/$url_img"); //se elimina la  Imagen 
                            }

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

                    if (isset($_POST['nombreproducto']) && validar_string($_POST['nombreproducto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $nombreproducto = $_POST['nombreproducto'];
                        $nombreproducto = eliminar_palabras_sql($nombreproducto);
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
                    if (isset($_POST['idproducto']) != false && validar_string($_POST['idproducto'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $idproducto = $_POST['idproducto'];
                        $idproducto = eliminar_palabras_sql($idproducto);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "idproducto No Valido";
                        echo  json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['stock']) && validar_int($_POST['stock']) && $_POST['stock'] > 0) {
                        $stock = $_POST['stock'];
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

                    if (isset($_POST['descripcion']) != false && validar_string($_POST['descripcion'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $descripcion = $_POST['descripcion'];
                        $descripcion = eliminar_palabras_sql($descripcion);
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "descripcion del Producto No Valida";
                        echo  json_encode($resultado);
                        break;
                    }

                    if (isset($_POST['moneda'])  && validar_int($_POST['moneda'])) {
                        $moneda = $_POST['moneda'];
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
                    if (isset($_POST['precio']) && validar_Monto($_POST['precio']) && $_POST['precio'] > 0) {
                        $precio = $_POST['precio'];
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
                                $new_img_name = $idproducto . '.' . $img_ex_lc; //creamos un nombre unico
                                // $img_upload_path = 'assets/uploads/' . $new_img_name; //ubicamos la carpeta donde se guardara
                                $img_upload_path = dirname(__FILE__, 4) . "/assets/uploads/" . $new_img_name; //ubicamos la carpeta donde se guardara

                                //session_name("ecomercer_admin_data");
                                session_start();
                                include_once "../../php/conexion.php";
                                $url_img_guardar = "/assets/uploads/$new_img_name"; //dirrecion donde estara almacenada la imagen

                                $consulta = " 
                            CALL adm_agregar_producto('$idproducto','$nombreproducto','$precio', '$stock','$categoria', '$descripcion','$url_img_guardar','$moneda','" . $_SESSION['Usuario']['id'] . "'); "; //[nombre][precio][stock][categoria][descripcion][imagen]
                                //asi la ejecuta phpmyadmin

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
                                $resultado->icono = "success";
                                $resultado->titulo = "";
                                $resultado->mensaje = "Formato de la Imagen No Valido, Solo jpg, jpeg, png, webp";
                                echo  json_encode($resultado);
                                break;
                            }
                        }
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "success";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Error Desconocido";
                        echo  json_encode($resultado);
                        break;
                    }
                    break;
                }


                if ($_POST['_method'] == "PUT") {

                    if (isset($_POST['validar']) &&  $_POST['validar'] == 1) {



                        if (isset($_POST['newdata']['stock'])) {
                            if (isset($_POST['newdata']['stock']) && validar_int($_POST['newdata']['stock']) && $_POST['newdata']['stock'] > 0) {
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
                            include_once "../../php/conexion.php";
                            session_name("ecomercer_admin_data");
                            session_start();
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

                            $consulta = "CALL adm_editar_producto( '$id', '0', '0', '0', '0','$stock','0','1','" . $_SESSION['Usuario']['id'] . "')"; //editar el stock

                            $resultado = mysqli_query($conexion, $consulta);
                            // echo $consulta;
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
                        } elseif ($_POST['newdata']['precio']) {
                            if (isset($_POST['newdata']['precio']) && validar_Monto($_POST['newdata']['precio']) && $_POST['newdata']['precio'] > 0) {
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


                            include_once "../../php/conexion.php";
                            // session_name("ecomercer_admin_data");
                            session_start();
                            $consulta = "CALL adm_editar_producto( '$id', '0', '0', '0', '0','0',$precio,'2','" . $_SESSION['Usuario']['id'] . "')"; //editar precio    

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
                                    $resultado->data =  array(
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
                                    $resultado->data =  array(
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
                                $resultado->icono = "";
                                $resultado->titulo = "";
                                $resultado->mensaje = "Error Interno";
                                echo  json_encode($resultado);
                                break;
                            }
                        }
                        break;
                    }


                    if (isset($_POST['ModalEditarID']) != false && validar_string($_POST['ModalEditarID'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                        $ModalEditarID = $_POST['ModalEditarID'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "ID No Valida";
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

                    if (isset($_POST['ModalEditarMoneda']) != false && $_POST['ModalEditarMoneda'] != "") {
                        $ModalEditarMoneda = $_POST['ModalEditarMoneda'];
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = false;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = "Moneda No Valida";
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
                        $ModalEditarID = "";
                        $ModalEditarNombreProducto = "";
                        $ModalEditarPrecio = "";
                        $ModalEditarMoneda = "";
                        $ModalEditarStock = "";
                        $ModalEditarCategoria = "";
                        $ModalEditarDescripcion = "";
                        */
                    include_once "../../php/conexion.php";
                    //session_name("ecomercer_admin_data");
                    session_start();
                    $consulta = "CALL adm_editar_producto( '$ModalEditarID',  '$ModalEditarNombreProducto', '$ModalEditarDescripcion', '$ModalEditarCategoria', '$ModalEditarMoneda','0','0',0,'" . $_SESSION['Usuario']['id'] . "')";
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
