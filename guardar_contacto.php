<?php
require 'includes/connection.php';
        var_dump($_POST['guardar_contacto']);
if (isset($_POST['guardar_contacto']) && isset($_POST['guardar_contacto']) == 'mensajeContacto'){
        $nombre = $_POST['nombre'];
        var_dump($_POST['nombre']);
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $comentario = $_POST['comentario'];
       
        $data = '';  
        $stmt = $connection->prepare("INSERT INTO contacto (nombre,email,telefono,comentario) VALUES(?,?,?,?)");
        $stmt->bind_param('sss', $nombre,$email,$telefono,$comentario);
        $stmt->execute();        

        $stmt2 = $connection->prepare('SELECT * FROM contacto');
        #$stmt2->bind_param('s', $_SESSION['idcliente']);
        $stmt2->execute();
        $results = $stmt2->get_result();
        $contacto = null;
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $contacto = $row;
            }
        }
        $data .= '<div class="text-center">
                                  <h1 class="display-4 mt-2 text-danger">Gracias por tu mensaje!</h1>
                                  <h4>Nombre : ' . $contacto['nombre'] . '</h4>
                                  <h4>Email : ' . $contacto['email'] . '</h4>
                                  <h2 class="text-success">Hemos recibido tus comentarios correctamente!</h2>                                  
                            </div>';
        echo $data;

    }else{
        echo "erro";
    }
?>