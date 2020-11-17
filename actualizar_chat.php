<?php
include "conexion.php";
$idcliente=1; // asignar variable de sesion login

$consulta="select a.fecha,a.tipo,a.mensaje,b.nombre as cliente from chat as a left join clientes as b on a.idcliente=b.idcliente where a.idcliente='$idcliente' order by a.idchat asc";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
    $fecha=$registro["fecha"];
    $tipo=$registro["tipo"];
    $mensaje=$registro["mensaje"];
    $cliente=$registro["cliente"];
    if($tipo==1){ // mensaje escrito por el usuario de la tienda
    ?>
        <div class="row msg_container base_sent">
            <div class="col-md-10 col-xs-10">
                <div class="messages msg_sent">
                    <p><?php echo $mensaje;?></p>
                    <time datetime="<?php echo $fecha; ?>"><?php echo $cliente; ?></time>
                </div>
            </div>
            <div class="col-md-2 col-xs-2 avatar">
                <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
            </div>
        </div>
    <?php
    }else{ // respuesta por parte del admin
    ?>
        <div class="row msg_container base_receive">
            <div class="col-md-2 col-xs-2 avatar">
                <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
            </div>
            <div class="col-md-10 col-xs-10">
                <div class="messages msg_receive">
                    <p><?php echo $mensaje; ?></p>
                    <time datetime="<?php echo $fecha; ?>">Administrador</time>
                </div>
            </div>
        </div>

    <?php        
    }               
}

?>