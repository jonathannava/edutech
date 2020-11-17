<?php
session_start();
require 'includes/connection.php';

if (isset($_SESSION['idcliente'])) {

  $records = $connection->prepare('SELECT idcliente, email, password FROM clientes WHERE idcliente = ?');
  $records->bind_param('s', $_SESSION['idcliente']);
  $records->execute();
  $results = $records->get_result();
  $user = null;
  if ($results->num_rows > 0) {
    while ($row = $results->fetch_assoc()) {
      $user = $row;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="/css/style.css"> -->
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>EduTech</title>
</head>

<body>
  <div class="container">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img class="logo" src="images/logo.svg" alt="edutech" width="150px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacto.php">Contacto</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="search" id="search_text" placeholder="Buscar Curso">
          </form>
          <?php if (!empty($user)) : ?>
            <div>
              <span class="text-white"><?= $user['email']; ?></span>
              <a class="btn btn-outline-success text-white" href="logout.php">Logout</a>
            </div>
          <?php else : ?>
            <div>
              <span class="text-white"></span>
              <a class="btn btn-outline-success text-white" href="login.php">Registro/Login</a>
            </div>
          <?php endif; ?>
          <a href="carrito.php" title="Placeholder link title" class="text-decoration-none">
            <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class=" bi bi-cart4 text-white ml-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
            </svg>
            <span id="cart-Item" class="badge badge-success mr-2 p-2"></span>
          </a>

        </div>
      </nav>
    </header>
    <main>
      <div class="container">
        <div class="row ">
          <div class="col-md-3">
            <p class="lead text-center font-weight-bold mt-2">Cursos</p>
            <ul class="list-group">
              <?php
              require_once 'includes/connection.php';
              $query = "SELECT * FROM categorias";
              $sendQuery = mysqli_query($connection, $query);
              $sendQueryCheck = mysqli_num_rows($sendQuery);

              while ($row = mysqli_fetch_assoc($sendQuery)) {
              ?>
                <li class="list-group-item list-group-item-action list-group-item-info">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input product_check" value="<?= $row['idcategoria']; ?>" id="idcategoria"><?= $row['descripcion']; ?>
                    </label>
                  </div>
                </li>


              <?php  }
              ?>

            </ul>
          </div>
          <div class="col-md-9">
            <div class="album py-5">
              <div class="container">
                <div id="messageItem"></div>
                <!-- <div id="message"></div> -->
                <div class="row row-cols-1 row-cols-md-3 mt-2" id="result">
                  <?php
                  $query = $connection->prepare("SELECT * FROM productos");
                  $query->execute();
                  $result = $query->get_result();
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
                            <input type="hidden" class="idcliente" value="<?= $_SESSION['idcliente'] ?>">
                            <input type="hidden" class="idproducto" value="<?= $row['idproducto'] ?>">
                            <!-- <input type="hidden" class="productoURLimagen" value="<?= $row['urlimagen'] ?>">
                            <input type="hidden" class="productoDescripcion" value="<?= $row['descripcion'] ?>"> -->
                            <input type="hidden" class="productoPrecio" value="<?= $row['precio'] ?>">
                            <button class="btn btn-info btn-block addItemButton">Agregar al carrito</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php endwhile;
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
    <section class="bodyChat">
      <div id="chat" class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading top-bar">
              <div class="col-md-8 col-xs-8">
                <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat</h3>

              </div>
              <div class="col-md-4 col-xs-4" style="text-align: right;">
                <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
              </div>
            </div>
            <div class="panel-body msg_container_base">
              <div id="mschat"></div>

            </div>
            <?php if (!empty($user)) : ?>
              <div class="panel-footer">
              <div class="input-group">
                <input id="texto" type="text" class="form-control input-sm chat_input p-1 " placeholder="Escribe tu texto aqui..." />
                <span class="input-group-btn">
                  <button class="btn btn-primary btn-sm p-2" id="btn-chat" onclick="enviar()">Enviar</button>
                </span>
              </div>
              <div class="panel-body msg_container_base">
              </div>
            </div>
            <?php else : ?>
              <div class="panel-footer">
              <div class="input-group">
                <input id="texto" type="text" class="form-control input-sm chat_input p-1 " placeholder="Inicie sesión para usar el chat." />
                <span class="input-group-btn">
                  <button disabled class="btn btn-primary btn-sm p-2" id="btn-chat" onclick="enviar()">Enviar</button>
                </span>
              </div>
              <div class="panel-body msg_container_base">
              </div>
            </div>
            <?php endif; ?>

          </div>
        </div>
    </section>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
      <div class="row">
        <div class="col-12 col-md">
          <img class="mb-2" src="images/logo_black.svg" alt="" width="150">
          <small class="d-block mb-3 text-muted">©2020 EduTech</small>
        </div>
        <div class="col-6 col-md">
          <h5>Cursos</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Programación</a></li>
            <li><a class="text-muted" href="#">Diseño Web</a></li>
            <li><a class="text-muted" href="#">Desarrollo Web</a></li>
            <li><a class="text-muted" href="#">Seguridad Informática</a></li>
            <li><a class="text-muted" href="#">Redes</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Nosotros</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Contacto</a></li>
            <li><a class="text-muted" href="#">Soporte</a></li>
            <li><a class="text-muted" href="#">Preguntas frecuentes</a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {

      $(".addItemButton").click(function(e) {
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var idcliente = $form.find(".idcliente").val();
        var idproducto = $form.find(".idproducto").val();
        var productoPrecio = $form.find(".productoPrecio").val();

        $.ajax({
          url: 'ItemAction.php',
          method: 'post',
          data: {
            idcliente: idcliente,
            idproducto: idproducto,
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
  <script src="code.js?ver=<?php echo rand(1, 300); ?>"></script>
</body>

</html>