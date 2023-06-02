<?php

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'POST':
        include_once '../../php/conexion.php';
        include_once '../../php/FuncionesGenerales.php';


        if (isset($_POST['usuario']) && validar_string($_POST['usuario'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
            $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
            $usuario = eliminar_palabras_sql($usuario);
        } else {
            header("Location: ../../login.php?error1=Usuario o Contraseña Incorrecta");
            exit();
        }
        if (isset($_POST['clave']) && validar_string($_POST['clave'], 'abcdefghijklmnopqrstuvwxyzñáéíóúàèìòùâêîôûäëïöüÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÑABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*._-$& ')) {
            $clave = htmlspecialchars($_POST['clave'], ENT_QUOTES, 'UTF-8');
            $clave  = eliminar_palabras_sql($clave);
        } else {
            header("Location: ../../login.php?error1=Usuario o Contraseña Incorrecta");
            exit();
        }






        $consulta = "SELECT * FROM `admin-users` WHERE nombre = '$usuario' and clave = '$clave' ";


        $resultado = mysqli_query($conexion, $consulta);
        $row = mysqli_fetch_assoc($resultado);
        if (count($row) > 0) { //validamos que obtengamos resultados
            session_set_cookie_params(1800); //Tiempo de vida de la variables session [ 1800 = 30 Minutos ]
            session_name("ecomercer_admin_data");
            session_start();
            $id = $row['id'];
            $consulta = "    
            SELECT
            id,
            user_id,
            agregarproducto,
            editarproducto,
            eliminarproducto,
            agregarcategoria,
            editarcategoria,
            eliminarcategoria
                FROM
            permisos
                WHERE
            user_id = $id";

            $resultado = mysqli_query($conexion, $consulta);
            $row2 = mysqli_fetch_assoc($resultado);

            $_SESSION['Usuario'] = $row;
            $_SESSION['Permisos'] = $row2;
            // echo json_encode($_SESSION);
            header("Location: ../../index.php");
        } else {
            header("Location: ../../login.php?error1=Usuario o Contraseña Incorrecta");
        }
        break;
}
