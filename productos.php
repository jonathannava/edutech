<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="/css/style.css"> -->
  <title>EduTech</title>
</head>

<body>
  <div class="container">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html"><img class="logo" src="images/logo.svg" alt="edutech"
            width="150px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="productos.php">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacto.html">Contacto</a>
            </li>            
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" name="search" id="search_text" placeholder="Buscar Curso">            
          </form>
          <li>
          <a class="btn btn-outline-success text-white" href="#">Registro/Login</a>
          </li>
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
                $query="SELECT * FROM categorias";
                $sendQuery= mysqli_query($connection, $query);
                $sendQueryCheck = mysqli_num_rows($sendQuery);
                
                  while($row = mysqli_fetch_assoc($sendQuery)){
                  ?>                    
                    <li class="list-group-item list-group-item-action list-group-item-info">
                      <div class="form-check">
                        <label  class="form-check-label">
                          <input type="checkbox" class="form-check-input product_check" value="<?=$row['idcategoria'];?>" id="idcategoria"><?= $row['descripcion'];?>
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
                <div class="row row-cols-1 row-cols-md-3 mt-2" id="result">                  
                  <?php
                    $query="SELECT * FROM productos";
                    $sendQuery= mysqli_query($connection, $query);
                    $sendQueryCheck = mysqli_num_rows($sendQuery);
                    if($sendQueryCheck > 0){
                      while($row = mysqli_fetch_assoc($sendQuery)){
                        echo "
                        <div class='col-md-6 mb-4 '>
                          <div class='card border border-success '> 
                            <img class='card-img-top' src='{$row['urlimagen']}' alt='Card image cap'>
                            <div class='card-body'>
                            <h5 class='card-title '>{$row['descripcion']} </h5>
                            <p class='card-text'>Precio: <span class='text-danger font-weight-bold'>\${$row['precio']}</span></p>                      
                            </div>
                          </div>
                        </div>                      
                        " ;
                      }
                    }
                  ?>     
                </div>
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  
  <script>
    $(document).ready(function(){
      $(".product_check").click(function(){
        var action = 'data';
        var idcategoria = get_categories('idcategoria');
        $.ajax({
          url:'action.php',
          method:'POST',
          data:{action:action,idcategoria:idcategoria},
          success:function(response){
            $("#result").html(response);
            
          }
        });
      });

      $("#search_text").keyup(function(){
        var search = $(this).val();
        $.ajax({
          url:'search.php',
          method:'POST',
          data:{query:search},
          success:function(response){
            $("#result").html(response);
            
          }
        });

      });


      function get_categories(text_id){
        var filterData=[];
        $('#'+text_id+':checked').each(function(){
          filterData.push($(this).val());
        });
        return filterData;
      }
    });
  </script>
</body>
</html>