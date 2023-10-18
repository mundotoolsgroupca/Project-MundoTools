<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        session_name("ecomercer_user_data");
        session_start();
        $http = getallheaders();
        if (!empty($http['X-Csrf-Token'])) {
            if (!isset($_SESSION['token'])) {
                http_response_code(409); //error
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
                include_once '../../php/conexion.php';
                include_once '../../php/FuncionesGenerales.php';


                if (isset($_POST['nombre']) && validar_string($_POST['nombre'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
                    $nombre = eliminar_palabras_sql($nombre);
                } else {
                    http_response_code(409); //error
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    break;
                }

                if (isset($_POST['clave']) && validar_string($_POST['clave'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
                    $clave = htmlspecialchars($_POST['clave'], ENT_QUOTES, 'UTF-8');
                    $clave  = eliminar_palabras_sql($clave);
                } else {
                    http_response_code(409); //error
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Parametro No Valido';
                    echo json_encode($resultado);
                    break;
                }






                $consulta = "SELECT * FROM vendedores WHERE nombre_usuario = '$nombre' and clave = '$clave' ";


                $resultado = mysqli_query($conexion, $consulta);
                $row = mysqli_fetch_assoc($resultado);

                if (!isset($row['activo'])) {
                    http_response_code(409); //error
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Datos Incorrectos';
                    echo json_encode($resultado);
                    break;
                }


                if ($row['activo'] == 1) {

                    $_SESSION['usuario'] = $row;
                    http_response_code(200); //error
                    $resultado = new stdClass();
                    $resultado->result = TRUE;
                    $resultado->icono = "success";
                    $resultado->titulo = "";
                    $resultado->mensaje = "";
                    $resultado->data = '';

                    echo  json_encode($resultado);
                    return;
                } else {
                    http_response_code(409); //error
                    // Log this as a warning and keep an eye on these attempts
                    $resultado = new stdClass();
                    $resultado->result = FALSE;
                    $resultado->icono = "error";
                    $resultado->titulo = "Error!";
                    $resultado->mensaje = 'Usuario Suspendido';
                    echo json_encode($resultado);
                    break;
                }
            } else {
                http_response_code(409); //error
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
            http_response_code(409); //error
            $resultado = new stdClass();
            $resultado->result = FALSE;
            $resultado->icono = "error";
            $resultado->titulo = "Error!";
            $resultado->mensaje = 'El token no fue enviado en el formulario';
            echo json_encode($resultado);
            break;
        }
}
