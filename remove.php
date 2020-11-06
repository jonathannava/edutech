<?php
session_start();
require_once 'includes/connection.php';
if (isset($_GET['remove'])) {
    $_SESSION['grandTotal']=0;
    $id = $_GET['remove'];
    var_dump($_GET['remove']);

    $stmt = $connection->prepare('DELETE FROM carrito WHERE idproducto=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['messageRemove'] = 'Producto borrado del carrito!';
    header('location:carrito.php');
  }
  if (isset($_GET['clear'])) {
    $_SESSION['grandTotal']=0;
    $stmt = $connection->prepare('DELETE FROM carrito');
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['messageRemove'] = 'Todos los productos borrados del carrito!';
    header('location:carrito.php');
  }

?>