<?php

// Parámetros de conexión a la base de datos


$dbhost = 'localhost';
$dbuser = 'mundotools';
$dbpass = 'wh3006Wv@';
$dbname = 'mundotools';


/*
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'mundotoolgroupbd';
*/
// Conexión a la base de datos
$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_set_charset($conexion, "utf8");
// Verificar si la conexión fue exitosa
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}
