<?php
    require_once 'includes/connection.php';
    $output='';
    if(isset($_POST['query'])){
        $search=$_POST['query'];
        $sql=$connection->prepare("SELECT * FROM productos WHERE descripcion LIKE CONCAT('%',?,'%') ");
        $sql->bind_param("s",$search);

    }
    else{
        $sql=$connection->prepare("SELECT * FROM productos");
    }
    $sql->execute();
    $result=$sql->get_result();
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $output.="
            <div class='col-md-6 mb-4 '>
              <div class='card border border-success '> 
                <img class='card-img-top' src='{$row['urlimagen']}' alt='Card image cap'>
                <div class='card-body'>
                <h5 class='card-title '>{$row['descripcion']} </h5>
                <p class='card-text'>Precio: <span class='text-danger font-weight-bold'>\${$row['precio']}</span></p>                      
                </div>
              </div>
            </div>                      
            ";
            
        }
        echo $output;
        
    }
    else{
            echo "<h3>Producto no encontrado.</h3>";
        }
?>