<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<?php
  if (file_exists('./xml/encartelera.xml')) {
      $xml = simplexml_load_file('./xml/encartelera.xml');
  } else {
      exit('Error abriendo datos de la cartelera');
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Cartelera</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php
        $aux=[];
        foreach($xml->film as $fila){
          if(!in_array((string)$fila['cine'],$aux)){
            echo '<li class="nav-item">';
            if(isset($_GET['cine']) && $_GET['cine']==(string)$fila['cine']){
              echo '<a class="nav-link active" href="index.php?cine='.$fila['cine'].'">'.$fila['cine'].'</a>';
            }
            else{
              echo '<a class="nav-link" href="index.php?cine='.$fila['cine'].'">'.$fila['cine'].'</a>';
            }
            echo '</li>';
            array_push($aux,(string)$fila['cine']);
          }
        }

        ?>
      </ul>
    </div>
  </div>
</nav>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img/img_1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/img_2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./img/img_3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div>
  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Pelicula</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Tema</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_GET['cine'])){
          foreach($xml->film as $fila){
            if($_GET['cine']==$fila['cine']){
            echo '<tr>';
               echo '<td>'.$fila->title.'</td>';
               echo '<td class="hidden">'.$fila->description.'</td>';
               echo '<td>'.$fila->description['tema'].'</td>';
            echo '</tr>';
          }
        }
        }
        else{
          foreach($xml->film as $fila){
            echo '<tr>';
               echo '<td>'.$fila->title.'</td>';
               echo '<td class="hidden">'.$fila->description.'</td>';
               echo '<td>'.$fila->description['tema'].'</td>';
            echo '</tr>';
        }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>