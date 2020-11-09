<?php
session_start();
require 'includes/connection.php';
	if (isset($_POST['insertOrder']) && isset($_POST['insertOrder']) == 'order') {
        
        $idcliente = $_SESSION['idcliente'];
        $recibe = $_POST['recibe'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $municipio = $_POST['municipio'];
        $estado = $_POST['estado'];
        $cp = $_POST['cp'];
        $tel = $_POST['tel'];  
        $data = '';  
        $stmt = $connection->prepare("INSERT INTO pedido (idcliente,recibe,calle,colonia,estado,municipio,cp,telefono) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bind_param('isssssss', $idcliente, $recibe, $calle, $colonia, $municipio, $estado, $cp, $tel);
        $stmt->execute();
        $stmt2 = $connection->prepare('DELETE FROM carrito');
        $stmt2->execute();

        $stmt2 = $connection->prepare('SELECT * FROM clientes WHERE idcliente = ?');
        $stmt2->bind_param('s', $_SESSION['idcliente']);
        $stmt2->execute();
        $results = $stmt2->get_result();
        $user = null;
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $user = $row;
            }
        }
        $data .= '<div class="text-center">
                                  <h1 class="display-4 mt-2 text-danger">Gracias!</h1>
                                  <h2 class="text-success">Tu pedido se realizó correctamente!</h2>
                                  <h4>Nombre : ' . $user['nombre'] . '</h4>
                                  <h4>Email : ' . $user['email'] . '</h4>
                                  <h4>Total : ' . number_format($_SESSION['grandTotal'], 2) . '</h4>
                            </div>';
        echo $data;
    }

?>