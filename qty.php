<?php
session_start();
require_once 'includes/connection.php';
/* if (isset($_SESSION['idcliente'])) {
    if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
        $stmt = $connection->prepare('SELECT * FROM carrito');
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
        echo $rows;
    }
} */

if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $connection->prepare('SELECT * FROM carrito');
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;
    echo $rows;
}