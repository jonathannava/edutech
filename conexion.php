<?php
date_default_timezone_set("America/Mexico_City");
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "bdtienda");
$tildes = $link->query("SET NAMES 'utf8'");
?>