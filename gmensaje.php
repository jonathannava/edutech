<?php
session_start();
include "conexion.php";
if (isset($_SESSION['idcliente'])) {
    $idcliente = $_SESSION['idcliente'];// asignar variable de sesion login
    $fecha = date('Y-m-d H:m:s');
    $mensaje = $_POST["texto"];
    $consulta = "insert into chat (fecha,idcliente,tipo,mensaje) values ('$fecha','$idcliente','1','$mensaje')";
    mysqli_query($link, $consulta);
}
