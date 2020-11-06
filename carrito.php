<?php
session_start();
require 'includes/connection.php';
if (isset($_SESSION['idcliente'])) {
    $_SESSION['grandTotal'] = 0;
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
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                                                echo $_SESSION['showAlert'];
                                            } else {
                                                echo 'none';
                                            }
                                            unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php if (isset($_SESSION['messageRemove'])) {
                                        echo $_SESSION['messageRemove'];
                                    }
                                    unset($_SESSION['showAlert']); ?></strong>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <td colspan="7">
                                            <h4 class="text-center text-info m-0">Productos en tu carrito</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID Producto</td>
                                        <td>Imagen</td>
                                        <td>Nombre</td>
                                        <td>Precio</td>
                                        <td>Cantidad</td>
                                        <td>Total</td>
                                        <th>
                                            <a href="remove.php?clear=all" class="badge-danger badge p-2" onclick="return confirm('limpiar carrito de compra');">Limpiar carrito</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <tr>
                                            <td><?= $row['idproducto']; ?></td>
                                            <td><img src="<?= $row['urlimagen']; ?>" alt="" width="50"></td>
                                            <td><?= $row['descripcion']; ?></td>
                                            <td><?= number_format($row['precio']); ?></td>
                                            <td><?= $row['cantidad']; ?></td>
                                            <?php $total = number_format($row['precio']) * $row['cantidad'] ?>
                                            <td><?= $total ?></td>
                                            <td>
                                                <a href="remove.php?remove=<?= $row['idproducto']; ?>" class="text-danger" onclick="return confirm('¿Seguro que deseas borrar este producto?');">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php                                         
                                            
                                            $_SESSION['grandTotal']=$_SESSION['grandTotal']+$total;                                         
                                         ?>
                                    <?php endwhile; ?>
                                    <tr>
                                        <td colspan="3">
                                            <a href="productos.php" class="btn btn-success">Continuar comprando</a>
                                        </td>
                                        <td colspan="2" class="font-weight-bold p-3">Total</td>
                                        <td class="font-weight-bold p-3"><?=$_SESSION['grandTotal']; ?></td>
                                        <td>
                                            <a href="procesarPago.php" class="btn btn-info <?= ($grandTotal > 1) ? "" : "disable"; ?>">Procesar Pago</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

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