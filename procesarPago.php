<?php
session_start();
require 'includes/connection.php';

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
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
            <section class="jumbotron text-center">                
                    <h2 class="jumbotron-heading">Pedido</h2>
                    <?php
                    require 'includes/connection.php';
                    $stmt = $connection->prepare('SELECT c.idcliente,p.idproducto,p.urlimagen,p.descripcion,p.precio,c.cantidad
                                        FROM carrito c, productos p
                                        WHERE c.idproducto = p.idproducto');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = 0;
                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <?= $row['descripcion'] ?>(<?= $row['cantidad'] ?>)|

                    <?php endwhile; ?>
                    <h2>Total de tu compra: <span class="text-danger"><?= number_format($_SESSION['grandTotal'], 2) ?></span></h2>               
            </section>            
                <form action="" method="POST" id="placeOrder" class="p-2">
                    <div class="form-group">
                        <label for="InputRecibe">Recibe:</label>
                        <input type="text" class="form-control" name="recibe" required>
                    </div>
                    <div class="form-group">
                        <label for="InputCalle">Calle:</label>
                        <input type="text" class="form-control" name="calle" required>
                    </div>
                    <div class="form-group">
                        <label for="InputColonia">Colonia:</label>
                        <input type="text" class="form-control" name="colonia" required>
                    </div>
                    <div class="form-group">
                        <label for="InputEstado">Estado:</label>
                        <input type="text" class="form-control" name="estado" required>
                    </div>
                    <div class="form-group">
                        <label for="InputMunicipio">Municipio:</label>
                        <input type="text" class="form-control" name="municipio" required>
                    </div>
                    <div class="form-group">
                        <label for="InputCP">Código Postal:</label>
                        <input type="text" class="form-control" name="cp" required>
                    </div>
                    <div class="form-group">
                        <label for="InputTelefono">Teléfono:</label>
                        <input type="text" class="form-control" name="tel" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block p-2 ">Realizar Pedido</button>
                    </div>
                </form> 
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $("#placeOrder").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'insertOrder.php',
                    method: 'post',
                    data: $('form').serialize() + "&insertOrder=order",
                    success: function(response) {
                        $("#order").html(response);
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
        });
    </script>

</body>

</html>