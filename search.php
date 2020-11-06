<?php
session_start();
require_once 'includes/connection.php';
$output = '';
if (isset($_POST['query'])) {
  $search = $_POST['query'];
  $sql = $connection->prepare("SELECT * FROM productos WHERE descripcion LIKE CONCAT('%',?,'%') ");
  $sql->bind_param("s", $search);
} else {
  $sql = $connection->prepare("SELECT * FROM productos");
}
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) :
?>
                  <div class="col-md-6 mb-4 ">
                    <div class="card border border-success ">
                      <img class="card-img-top" src="<?= $row['urlimagen'] ?>" alt="Card image cap">
                      <div class="card-body">
                        <h4 class="card-title "><?= $row['descripcion'] ?> </h4>
                        <h5 class="card-text">Precio: <span class="text-danger font-weight-bold">$<?= number_format($row['precio']) ?></span></h5>
                      </div>
                      <div class="card-footer">
                        <form action="" class="form-submit">                          
                          <input type="hidden" class="idcliente" value="<?=$_SESSION['idcliente']?>">   
                          <input type="hidden" class="idproducto" value="<?=$row['idproducto']?>">       
                          <input type="hidden" class="productoDescripcion" value="<?=$row['descripcion']?>">       
                          <input type="hidden" class="productoPrecio" value="<?=$row['precio']?>">                           
                          <button class="btn btn-info btn-block addItemButton">Agregar al carrito</button>
                        </form>
                      </div>
                    </div>
                  </div>
<?php endwhile;
} else {
  echo "<h3>Producto no encontrado.</h3>";
}
?>
  <script>
    $(document).ready(function() {

      $(".addItemButton").click(function(e) {
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var idcliente = $form.find(".idcliente").val();
        var idproducto = $form.find(".idproducto").val();
       /*  var productoURLimagen = $form.find(".productoURLimagen").val();
        var productoDescripcion = $form.find(".productoDescripcion").val(); */
        var productoPrecio = $form.find(".productoPrecio").val();

        $.ajax({
          url: 'ItemAction.php',
          method: 'post',
          data: {
            idcliente: idcliente,
            idproducto: idproducto,
           /*  productoURLimagen: productoURLimagen,
            productoDescripcion: productoDescripcion, */
            productoPrecio: productoPrecio
          },
          success: function(response) {
            $("#messageItem").html(response);
            window.scrollTo(0, 0);
            updateCartItemNumber();
          }
        });
      });
      updateCartItemNumber();

      function updateCartItemNumber() {
        $.ajax({
          url: 'qty.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-Item").html(response);
          }
        });
      }
      $(".product_check").click(function() {
        var action = 'data';
        var idcategoria = get_categories('idcategoria');
        $.ajax({
          url: 'action.php',
          method: 'POST',
          data: {
            action: action,
            idcategoria: idcategoria
          },
          success: function(response) {
            $("#result").html(response);

          }
        });
      });

      $("#search_text").keyup(function() {
        var search = $(this).val();
        $.ajax({
          url: 'search.php',
          method: 'POST',
          data: {
            query: search
          },
          success: function(response) {
            $("#result").html(response);
            $("#message").html(response);

          }
        });

      });

      function get_categories(text_id) {
        var filterData = [];
        $('#' + text_id + ':checked').each(function() {
          filterData.push($(this).val());
        });
        return filterData;
      }
    });
  </script>