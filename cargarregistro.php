<?php



$json_data = file_get_contents('data.json');
$data = json_decode($json_data, true);
foreach ($data as $item) {
    include "./php/conexion.php";
    foreach ($item['tabla']['numero de inventario'] as $contenttable1 => $value) {

        for ($i = 0; $i < count($item['tabla']['numero de inventario']); $i++) {

            $id = $item['tabla']['numero de inventario'][$i]["id"];
            $nombre = $item['tabla']['numero de inventario'][$i]["nombre"];
            $categoria = $item['tabla']['numero de inventario'][$i]["categoria"];
            $caracteristicas = $item['tabla']['numero de inventario'][$i]["caracteristicas"];
            $arrkey = [];

            foreach ($value as $key => &$valor) {
                if ($key != "id" && $key != "nombre" && $key != "caracteristicas" && $key != "categoria") {
                    array_push($arrkey, $key . ": " . $item['tabla']['numero de inventario'][$i][$key]);
                }
            }
            $descripcion1 = isset($arrkey[0]) ? $arrkey[0] : "";
            $descripcion2 = isset($arrkey[1]) ? $arrkey[1] : "";
            $descripcion3 = isset($arrkey[2]) ? $arrkey[2] : "";
            $descripcion4 = isset($arrkey[3]) ? $arrkey[3] : "";
            $descripcion5 = isset($arrkey[4]) ? $arrkey[4] : "";
 

            $consulta ="
            INSERT IGNORE INTO `productos2`(
                `id`,
                `nombre`,
                `descripcion`,
                `categoria`,
                `imagen`,
                `precio`,
                `moneda`,
                `caracteristica`,
                `caracteristica2`,
                `caracteristica3`,
                `caracteristica4`,
                `caracteristica5`
            )
            VALUES(
                '$id',
                '$nombre',
                '$caracteristicas',
                '1',
                '/assets/uploads/$id.png',
                '1',
                '1001',
                '$descripcion1 ',
                '$descripcion2 ',
                '$descripcion3 ',
                '$descripcion4 ',
                '$descripcion5'
            )
            ";
           

            $resultado = mysqli_query($conexion, $consulta);
        }
    }
}

 /* 
include "./php/conexion.php";

for ($i = 0; $i < count($arr); $i++) array(

    $id = $arrarray($i)array('id');
    $nombre = $arrarray($i)array('nombre');
    $id_categoria = $arrarray($i)array('id_categoria');
    $consulta = "
    INSERT INTO `productos`(
    `id`,
    `nombre`,
    `descripcion`,
    `categoria`,
    `imagen`,
    `precio`,
    `moneda`
)
VALUES(
    '$id',
    '$nombre',
    'lorem',
    '$id_categoria',
    '/assets/uploads/$id.png',
    '1',
    '101'
);
 
";
    $resultado = mysqli_query($conexion, $consulta);

    $sql = "
    INSERT INTO `stock`(`idProducto`, `cantidad`) VALUES('$id', '5')";
    $result = mysqli_query($conexion, $sql);
)
*/
/*
$uniqueCategories = array_reduce($arr, function ($acc, $item) array(
    $existingItem = array_filter($acc, function ($i) use ($item) array(
        return $iarray('id_categoria') === $itemarray('id_categoria');
    ));
    if (!$existingItem) array(
        $accarray() = array(
            'id_categoria' => $itemarray('id_categoria'),
            'categoria' => $itemarray('categoria')
        );
    )
    return $acc;
), array());
*/
/*
for ($i = 0; $i < count($uniqueCategories); $i++) array(

  
    $id_categoria = $uniqueCategoriesarray($i)array('id_categoria');
    $categoria = $uniqueCategoriesarray($i)array('categoria');
    $consulta = "
    INSERT INTO `categorias`(`id`, `nombre`)
    VALUES($id_categoria, '$categoria')
";
    $resultado = mysqli_query($conexion, $consulta); 

    
)

*/
//print_r($uniqueCategories);

/*

echo "
<script>console.log(" . json_encode($uniqueCategories) . ")</script>
";
*/