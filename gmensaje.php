<?php
/* include "conexion.php";
$idcliente=1; // variable de sesion proveniente de login del sitio */
session_start();
include "conexion.php";
#$idcliente=1; // asignar variable de sesion login
if (isset($_SESSION['idcliente'])) {
    $idcliente = $_SESSION['idcliente'];
    $fecha = date('Y-m-d H:m:s');
    $mensaje = $_POST["texto"];
    $consulta = "insert into chat (fecha,idcliente,tipo,mensaje) values ('$fecha','$idcliente','1','$mensaje')";
    mysqli_query($link, $consulta);
}
