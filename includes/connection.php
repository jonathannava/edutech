<?php
$DB_server="127.0.0.1";
$DB_user="root";
$DB_pass="#1#2#3";
$DB_name="tiendavirtual";

$connection = mysqli_connect($DB_server,$DB_user,$DB_pass,$DB_name);
$connection->set_charset("utf8");

?>