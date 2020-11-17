<?php
date_default_timezone_set("America/Mexico_City");
$link = mysqli_connect("localhost", "tiendavirtual", "#1#2#3");
mysqli_select_db($link, "tiendavirtual");
$tildes = $link->query("SET NAMES 'utf8'");
?>