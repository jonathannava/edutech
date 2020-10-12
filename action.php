<?php
    require_once 'includes/connection.php';
    if(isset($_POST['action'])){
        $sql = "SELECT * FROM productos WHERE idcategoria !=''";
        
        if(isset($_POST['idcategoria'])){
            $idcategoria=implode("','", $_POST['idcategoria']);
            
            $sql .="AND idcategoria IN('".$idcategoria."')";
        }
        $result = $connection->query($sql);
        $output='';
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
        }
        else{
            $output="No hay productos";
        }
        echo $output;
    }
?>