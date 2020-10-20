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
                <form class="form-signing w-50">
                    <img class="mb-4" src="images/usuario.svg" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
                    <p class="mb-3 font-weight-normal">o <a href="registro.php">registrarse</a></p>
                    <label for="inputEmail" class="sr-only">Correo Electrónico</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required="" autofocus="">
                    <label for="inputPassword" class="sr-only">Contraseña</label>
                    <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Contraseña" required="">
                    
                    <button class="mb-3 btn btn-lg btn-primary btn-block" type="submit">Ingresar</button> 
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>                   
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>