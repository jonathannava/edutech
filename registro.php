<?php

require_once 'includes/connection.php';

$message = '';

if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {
    $records = $connection->prepare('SELECT idcliente, email, password FROM clientes2 WHERE email = ?');
    $records->bind_param('s', $_POST['inputEmail']); 
    $records->execute();
    $results=$records->get_result();
    $message = '';
    if($results->num_rows>0){            
        #while($row=$results->fetch_assoc()){                
            $message = '
            <div class="alert alert-warning alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning! </strong>Este email ya está registrado.
            </div>                    
            ';
        #}                       
    }
    else {
        #if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {
            $sql = "INSERT INTO clientes2 (email, password, nombre) VALUES (?,?,?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param('sss', $email, $password, $name);
            $email = $_POST['inputEmail'];
            $name = $_POST['inputName'];
            $password = password_hash($_POST['inputPassword'], PASSWORD_BCRYPT);
            if ($stmt->execute()) {
                $message = '
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> Nuevo usuario creado satisfactoriamente.
                </div>
              ';
            } else {
                $message = '
                <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> Ocurrio un problema al crear la cuenta de susuario.
                </div>
              ';
            }
        #}


    }
}

/* if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])) {
    $sql = "INSERT INTO clientes2 (email, password, nombre) VALUES (?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('sss', $email, $password, $name);
    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = password_hash($_POST['inputPassword'], PASSWORD_BCRYPT);
    if ($stmt->execute()) {
        $message = '
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Nuevo usuario creado satisfactoriamente.
        </div>
      ';
    } else {
        $message = '
        <div class="alert alert-warning alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong> Ocurrio un problema al crear la cuenta de susuario.
        </div>
      ';
    }
} */
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
                <a class="navbar-brand" href="index.html"><img class="logo" src="images/logo.svg" alt="edutech" width="150px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <a class="btn btn-outline-success text-white" href="login.php">Registro/Login</a>
                </div>
            </nav>
        </header>

        <main>
            <div class="d-flex justify-content-center text-center pt-4">
                <form name="registerForm" action="registro.php" method="POST" class="form-signing w-50">
                    <img class="mb-4" src="images/usuario.svg" alt="" width="72" height="72">
                    <?php if (!empty($message)) : ?>
                        <p> <?= $message ?></p>
                    <?php endif; ?>
                    <h1 class="h3 mb-3 font-weight-normal">Registrar usuario</h1>
                    <p class="mb-3 font-weight-normal">o <a href="login.php">iniciar sesión</a></p>
                    <label for="inputName" class="sr-only">Correo Electrónico</label>
                    <input name="inputName" type="text" id="inputName" class="form-control  mb-2" placeholder="Nombre" required="" autofocus="">
                    <label for="inputEmail" class="sr-only">Correo Electrónico</label>
                    <input name="inputEmail" type="email" id="inputEmail" class="form-control  mb-2" placeholder="Correo Electrónico" required="" autofocus="">
                    <label for="inputPassword" class="sr-only">Contraseña</label>
                    <input name="inputPassword" type="password" id="inputPassword" class="form-control  mb-2" placeholder="Contraseña" required="">
                    <label for="inputPasswordConfirm" class="sr-only">Confirmar Contraseña</label>
                    <input name="inputPasswordConfirm" type="password" id="inputPasswordConfirm" class="form-control mb-1" placeholder="Confirmar Contraseña" onkeyup='passwordConfirm();' required="">
                    <span id='message' class="mb-3"></span>
                    <button id="Button" class="mt-3 btn btn-lg btn-primary btn-block" type="submit" >Registrar</button>
                </form>
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
        $('#Button').prop('disabled', true);
        function passwordConfirm() {           
            if (document.getElementById('inputPassword').value == document.getElementById('inputPasswordConfirm').value) {
                //document.getElementById('message').style.color = 'green';
                document.getElementById('message').className="text-success";
                document.getElementById('message').innerHTML = '';
                /* document.registerForm.submit(); */
                $('#Button').prop('disabled', false);
            } else {
                document.getElementById('message').className = 'text-danger';
                document.getElementById('message').innerHTML = 'Las contraseñas no coinciden';  
                $('#Button').prop('disabled', true);              
            }
        }
    </script>
</body>

</html>