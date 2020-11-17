<?php
include "conexion.php";
$idcliente=$_POST["idcliente"]; 
$mensaje=$_POST["mensaje"];
$fecha=date('Y-m-d H:m:s');
$consulta="insert into chat (fecha,idcliente,tipo,mensaje) values ('$fecha','$idcliente','2','$mensaje')";
mysqli_query($link,$consulta);


?>