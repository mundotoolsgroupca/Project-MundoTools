<?php
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':

        if (isset($_GET['query']) && $_GET['query'] != "") {
            // obtenemos la pagina por GET, en caso que esta variable no este declarada  por default seria 1
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            // contidad de Resultados por pagina
            $results_per_page = 10;
            //formula para calcular los resultados de la tabla segun la pagina en que se esta
            $offset = ($current_page - 1) * $results_per_page;



            include_once '../../php/conexion.php';
            $query = $_GET['query'];
            $consulta = "
            SELECT
            c1.id,
            c1.nombre,
            c1.descripcion,
            c1.categoria,
            c1.imagen,
            c1.precio,
            c2.simbolo 
            FROM
            productos as c1
            INNER JOIN moneda_ref as c2 ON c2.cod_moneda = c1.moneda
            WHERE
            nombre LIKE '%$query%' LIMIT $results_per_page OFFSET $offset
            
            "; //consulta para obtener los resultados segun la pagina 
            $data = []; //variable que almacenara los resultados de la consulta
            $data['num_pages'] = 0; //cantida de paginas que tiene la consulta
            $resultado = mysqli_query($conexion, $consulta);
            while ($row = mysqli_fetch_assoc($resultado)) {


                array_push($data, [
                    "id" => $row['id'],
                    "nombre" => $row['nombre'],
                    "descripcion" => $row['descripcion'],
                    "categoria" => $row['categoria'],
                    "imagen" => $row['imagen'],
                    "precio" => str_replace(',', '.', number_format((float)$row['precio'], 2, ',', '')),
                    "simbolo" => $row['simbolo'],
                ]);
            }

            $sql_count = "SELECT COUNT(*) as count FROM productos WHERE nombre LIKE '%$query%'"; //consutla para obtener la cantida de paginas que tiene la consulta
            $count = mysqli_fetch_assoc(mysqli_query($conexion, $sql_count))['count'];
            $data['num_pages'] = ceil($count / $results_per_page); //agregarmos la cantidad de paginas que tiene al array principal 

            http_response_code(200); //Success
            echo json_encode($data); //retornamos los datos
            break;
        } else {
            http_response_code(409); //error
            echo json_encode([]); //retornamos los datos
        }
        /*
        include_once '../../php/conexion.php';
        // Configurar los encabezados de la respuesta

        $consulta = "
            SELECT
            c1.id,
            c1.nombre,
            c1.descripcion,
            c1.categoria,
            c1.imagen,
            c1.precio,
            c2.simbolo 
            FROM
            productos as c1
            INNER JOIN moneda_ref as c2 ON c2.cod_moneda = c1.moneda
     ";
        $resultado = mysqli_query($conexion, $consulta);
        $data = [];
        while ($row = mysqli_fetch_assoc($resultado)) {


            array_push($data, [
                "id" => $row['id'],
                "nombre" => $row['nombre'],
                "descripcion" => $row['descripcion'],
                "categoria" => $row['categoria'],
                "imagen" => $row['imagen'],
                "precio" => str_replace(',', '.', number_format((float)$row['precio'], 2, ',', '')),
                "simbolo" => $row['simbolo'],
            ]);
        }
        echo json_encode($data);
*/
        break;
}
