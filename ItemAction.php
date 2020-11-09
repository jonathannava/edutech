<?php
session_start();
require_once 'includes/connection.php';
if (isset($_SESSION['idcliente'])) {
    $idcliente = $_POST['idcliente'];
    $idproducto = $_POST['idproducto'];
    $productoPrecio = $_POST['productoPrecio'];
    $cantidad = 1;

    $stmt = $connection->prepare("SELECT idproducto,cantidad FROM carrito WHERE idproducto=?");
    $stmt->bind_param("s", $idproducto);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['idproducto'];
    if (!$code) {
        $query = $connection->prepare("INSERT INTO carrito (idcliente, idproducto, cantidad, precio) VALUES (?,?,?,?)");
        $query->bind_param("iiii", $idcliente, $idproducto, $cantidad, $productoPrecio);
        $query->execute();
        echo '
                    <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Nuevo </strong>Producto agregado.
                    </div>                    
                    ';
    } else {
        $cantidad = $r['cantidad'] + 1;

        $query = $connection->prepare("UPDATE carrito SET cantidad=? WHERE idproducto=?");
        $query->bind_param("ii", $cantidad, $idproducto);
        $query->execute();
        echo '
                    <div class="alert alert-secondary alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Producto agregado anteriormente,<strong> cantidad actualizada.</strong> 
                    </div>                    
                    ';
    }
} else {
    echo '
    <div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Para agregar un producto necesita<a href="login.php"><strong> Iniciar sesión.</strong></a> 
    </div>                    
   ';

}
