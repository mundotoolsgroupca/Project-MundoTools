<?php

session_name("ecomercer_admin_data");
session_start();

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        break;
    case 'POST':
        include_once '../../php/FuncionesGenerales.php';
        include_once '../../php/conexion.php';
        $http = getallheaders();


        if (!empty($http['X-Csrf-Token'])) {

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

            if (hash_equals($_SESSION['token'], $http['X-Csrf-Token'])) {

                if (isset($_POST['modal_idorden_temp'])) {
                    $id_orden = $_POST['modal_idorden_temp'];
                } else {
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    break;
                }


                /************************************* Si el Array no con tiene modificacion, se procesa de una *************************************/
                $id_admin = $_SESSION['Usuario']['id'];

                if (isset($_POST['arr_original_modificado'])) {
                    $arr_original_modificado = $_POST['arr_original_modificado'];
                } else {
                    $consulta = "CALL adm_procesar_orden('$id_orden','$id_admin')";
                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado) {
                        $data_result = mysqli_fetch_assoc($resultado);
                        // Log this as a warning and keep an eye on these attempts
                        http_response_code(200); //sucess
                        $resultado = new stdClass();
                        $resultado->result = true;
                        $resultado->icono = "";
                        $resultado->titulo = "";
                        $resultado->mensaje = $data_result['msg'];
                        echo json_encode($resultado);
                        break;
                    } else {
                        // Log this as a warning and keep an eye on these attempts
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Error Interno';
                        echo json_encode($resultado);
                        break;
                    }
                    return;
                }

                /*
                for ($i = 0; $i < count($arr_original_modificado); $i++) { //validamos el stock en cada producto para validar que este disponible 
                    $producto_id = $arr_original_modificado[$i]['producto_id'];
                    $cantidad = $arr_original_modificado[$i]['cantidad'];

                    $consulta = "
                        SELECT
                            stock.idProducto, 
                            stock.cantidad
                        FROM
                            stock
                        where
                            IdProducto ='$producto_id' ";


                    //consulta para obtener los resultados segun la pagina 
                    $resultado = mysqli_query($conexion, $consulta);
                    $newid = "";
                    if ($resultado) {
                        $data = mysqli_fetch_assoc($resultado);


                        // Check if there is enough stock for the requested quantity
                        if ($data['cantidad'] <= $cantidad) {

                            http_response_code(409); //codigo de conflicto
                            $resultado = new stdClass();
                            $resultado->result = FALSE;
                            $resultado->icono = "error";
                            $resultado->titulo = "Error!";
                            $resultado->mensaje = 'Un Producto  No Posee Suficiente Stock';
                            echo json_encode($resultado);
                            return  $resultado;
                        }
                    } else {
                        http_response_code(409); //codigo de conflicto
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Error Interno';
                        echo json_encode($resultado);
                        return  $resultado;
                    }
                }
*/
                /******************************************************************************* */


                if (isset($_POST['arr_original'])) {
                    $arr_original = $_POST['arr_original'];
                } else {
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    break;
                }



                //validamos el id de la orden
                if (!validar_int($id_orden)) {
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Id Orden no Valida No Valida';
                    echo json_encode($resultado);
                    return;
                }

                //validamos los datos del array
                for ($i = 0; $i < count($arr_original); $i++) {
                    if (!validar_int($arr_original[$i]['producto_id'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id No Valido';
                        echo json_encode($resultado);
                        return;
                    }

                    if (!validar_int($arr_original[$i]['cantidad'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Cantida No Valida';
                        echo json_encode($resultado);
                        return;
                    }
                }
                for ($i = 0; $i < count($arr_original_modificado); $i++) {
                    if (!validar_int($arr_original_modificado[$i]['producto_id'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Id No Valido';
                        echo json_encode($resultado);
                        return;
                    }

                    if (!validar_int($arr_original_modificado[$i]['cantidad'])) {
                        http_response_code(409); //error 
                        $resultado = new stdClass();
                        $resultado->result = FALSE;
                        $resultado->icono = "error";
                        $resultado->titulo = "Error!";
                        $resultado->mensaje = 'Cantida No Valida';
                        echo json_encode($resultado);
                        return;
                    }
                }




                $consulta = "CALL adm_devolucion_parcial('$id_admin','$id_orden')";

                $resultado = mysqli_query($conexion, $consulta);

                if ($resultado) {

                    adm_devolucion_parcial_det($arr_original_modificado, $arr_original, $id_orden, $conexion);
                } else {
                    // Log this as a warning and keep an eye on these attempts
                    http_response_code(409); //error 
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Error Interno';
                    echo json_encode($resultado);
                    break;
                }
            } else {
                // Log this as a warning and keep an eye on these attempts
                http_response_code(409); //error 
                $resultado = new stdClass();
                $resultado->result = FALSE;
                $resultado->icono = "error";
                $resultado->titulo = "Error!";
                $resultado->mensaje = 'El token enviado no es valido';
                echo json_encode($resultado);
                break;
            }
        } else {
            http_response_code(409); //error 
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



function adm_devolucion_parcial_det($arr_original_modificado, $arr_original, $id_orden, $conexion)
{
    include_once '../../php/FuncionesGenerales.php';

    while (mysqli_more_results($conexion)) { // Clean up all old results and prepare to display the new ones
        mysqli_next_result($conexion);
    }



    for ($j = 0; $j < count($arr_original_modificado); $j++) {
        $producto_id = $arr_original_modificado[$j]['producto_id'];
        $cantidad = $arr_original_modificado[$j]['cantidad'];
        $arr_filter = buscarPorId($arr_original, $producto_id);

        if ($arr_filter != null) {
            $cantidad_inicial = $arr_filter['cantidad'];
            $cantidad_final = $arr_filter['cantidad'] - $cantidad;
            if ($cantidad_final < 0) {
                $cantidad_final = 0;
            }
            $consulta = "CALL adm_devolucion_parcial_det('$id_orden','$producto_id','$cantidad_inicial','$cantidad_final');";
            $consulta_resultado = mysqli_query($conexion, $consulta);
        } else {
            // Log this as a warning and keep an eye on these attempts
            //http_response_code(409); //error 
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'Error Interno';
            echo json_encode($resultado);
            break;
        }
    }

    //http_response_code(200); //success
    $resultado = new stdClass();
    $resultado->result = true;
    $resultado->icono = "";
    $resultado->titulo = "";
    $resultado->mensaje = 'Realizado';
    echo json_encode($resultado);
    break;
}
