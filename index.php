<?php
session_start();
require 'includes/connection.php';
if (isset($_SESSION['idcliente'])) {
  $records = $connection->prepare('SELECT idcliente, email, password, nombre FROM clientes WHERE idcliente = ?');
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
        </div>
        <?php if (!empty($user)) : ?>
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Usuario encontrado</h5>
                  
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">Bienvenid@ <?= $user['nombre']; ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                 
                </div>
              </div>
            </div>
          </div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
            <script type="text/javascript">
              $(function() {
                $("#myModal").modal();
              });
            </script>
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
      </nav>
    </header>

    <main>
      <section>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/Curso_PHP_Imagen.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/Curso_JS_Imagen.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/Curso_CSS3_Imagen.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/Curso_EH_Imagen.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/Curso_Redes_Imagen.png" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </section>
      <div class="py-5 text-center">
        <h2>¿Qué quieres aprender hoy?</h2>
      </div>
      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-4   cursor-pointer">
              <div class="card mb-4 box-shadow">
                <a href="#"><img class="card-img-top" alt="" src="images/programacion.png" width="600px"> </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <a href="#"><img class="card-img-top" alt="" src="images/si.png"></a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <a href="#"><img class="card-img-top" alt="" src="images/redes.png"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="py-5 text-center">
        <h2>Nuevos Cursos</h2>
      </div>
      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" alt="" src="images/Curso_CSS3_Imagen.png">
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" alt="" src="images/Curso_EH_Imagen.png">
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" alt="" src="images/Curso_Redes_Imagen.png">
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>