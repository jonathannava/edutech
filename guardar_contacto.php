<?php
require 'includes/connection.php';
if (isset($_POST['guardar_contacto']) && isset($_POST['guardar_contacto']) == 'mensajeContacto') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $comentario = $_POST['comentario'];
    $data = '';
    $stmt = $connection->prepare("INSERT INTO contacto (nombre,email,telefono,comentario) VALUES(?,?,?,?)");
    $stmt->bind_param('ssss', $nombre, $email, $telefono, $comentario);
    $stmt->execute();

    $stmt2 = $connection->prepare('SELECT * FROM contacto WHERE telefono = ?');
    $stmt2->bind_param('s', $telefono);
    $stmt2->execute();
    $results = $stmt2->get_result();
    $contacto = null;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $contacto = $row;
        }
        $data .= '<div class="text-center">
            <h2 class="display-6 mt-2 text-success">Gracias por tu mensaje!</h2>                     
            <h3 class="mt-2 text-info">' . $contacto['email'] . '</h3>
            <h4 class="text-succes">Hemos recibido tus comentarios correctamente!</h4>                                  
      </div>';
        echo $data;
    } else {
        $data .= '<div class="text-center">           
            <h2 class="text-danger">Error al recibir tus comentarios</h2>                                  
      </div>';
        echo $data;
    }
}
