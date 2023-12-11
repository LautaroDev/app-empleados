<?php 

$servidor = "localhost"; //127.0.0.1
$baseDeDatos="app";
$usuario = "root";
$contraseña="";


try {
    $conexion = new PDO("mysql:host=$servidor;
                        dbname=$baseDeDatos",
                        $usuario,$contraseña);
    echo "conexion exitosa";
} catch (Exeption $ex) {
    echo "Error de conexion: ". $ex->getMessage();
}


?> 