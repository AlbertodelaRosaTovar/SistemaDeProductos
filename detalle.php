<?php
session_start();
require_once 'cnn.php';
require_once 'cdn.html';
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalles De Productos</title>
  <link rel="icon" href="images/A.jpg" />
</head>

<body id="fondo">
  <style>
    #naz {
      background-color: #fff;
    }

    #fondo {
      background-color: #e6ebdd;
    }

    #loginform {
      background-color: #FFFFFF;
      border: 1px solid #ccc;
      box-shadow: 0px 2px .5px 1px #ccc;
    }
  </style>
  <!-- Navbar -->
  <nav id="naz" class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
      <!-- Navbar brand -->
      <a class="navbar-brand me-2" href="img/RK.png">
        <h1>Detalles de mis productos</h1>
      </a>
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Left links -->
      <div class="d-flex align-items-center">

        <a href="misProductos.php">
          <button type="button" class="btn btn-outline-dark me-3">
            Mis productos
          </button>
        </a>
      </div><!-- Collapsible wrapper -->
    </div><!-- Container wrapper -->
  </nav><!-- Navbar -->
  <br>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php
        $sql = "SELECT * FROM tabla_imagenes1";
        $stmt = $cnnPDO->prepare($sql);
        $stmt->execute();
        ?>

        <table class="table table-dark table-striped" border='1' align='center' width="100%">
          <tr>
            <th>Código</th>
            <th>descripcion</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Creacion</th>
          </tr>

          <?php
          while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $campo['codigo'] . '</td>';
            echo '<td>' . $campo['descripcion'] . '</td>';
            echo '<td>';
            echo "$ " . $campo['price'] . '</td>';
            echo '<td>' . $campo['stock'] . '</td>';
            echo '<td>' . $campo['creado'] . '</td>';
            echo '</tr>';
          }
          ?>
        </table>
      </div>
    </div>
  </div>

  <br>
  <br>
  <br>
  <div class=" offset-4 col-8">
    <a href="bienvenida.php" style="letter-spacing: 3px;">
      <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark">Volver</button>
    </a>
    <a href="cerrar.php" style="letter-spacing: 3px;">
      <button type="button" class="btn btn-outline-danger" data-mdb-ripple-color="dark">Cerar Sesión <i class="ace-icon fa fa-power-off"></i></button>
    </a>
  </div>
  </div>
  </div><!-- ROW -->
  </div><!-- Containerr -->
  <footer>
    <br>
    <br>
    <br>
    <hr>

    <center>
      <p>Copyright © Alberto De La Rosa Tovar</p>
    </center>
  </footer>
</body>

</html>