<?php
require_once 'cnn.php';
require_once 'cdn.html';

?>
<?php
if (isset($_POST["enviar"])) {
  $codigo = $_POST['codigo'];
  $descripcion = $_POST['descripcion'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $size = getimagesize($_FILES["imagen"]["tmp_name"]);
  if ($size !== false) {
    $cargarImagen = $_FILES['imagen']['tmp_name'];
    $imagen = fopen($cargarImagen, 'rb');

    // $imgContent = addslashes(file_get_contents($imagen));     
    $dataTime = date("Y-m-d H:i:s");

    $sql = $cnnPDO->prepare("INSERT INTO tabla_imagenes1
            (codigo, descripcion, price, stock, imagen, creado) VALUES (:codigo, :descripcion, :price, :stock, :imagen, :creado)");

    //Asignar el contenido de las variables a los parametros
    $sql->bindParam(':codigo', $codigo);
    $sql->bindParam(':descripcion', $descripcion);
    $sql->bindParam(':price', $price);
    $sql->bindParam(':stock', $stock);
    $sql->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
    $sql->bindParam(':creado', $dataTime);

    //Ejecutar la variable $sql
    $sql->execute();
    unset($sql);
  }
}
?>

<!-- Códigos de BUSQUEDA -->
<?php
//se verifica si se presiona el botón llamado buscar
if (isset($_POST['buscar'])) {

  //se guarda en las variables$us y $ps
  $codigo = $_POST['codigo'];

  //Query de CONSULTA
  $query = $cnnPDO->prepare('SELECT * from tabla_imagenes1 WHERE codigo =:codigo');


  //Manejo de parámetros
  $query->bindParam(':codigo', $codigo);

  //Execución del query
  $query->execute();
  //$count=$query->rowCount();

  //Asigna los datos del registro a la variable $campo
  $campo = $query->fetch();
}
?>

<!-- Códigos de ACTUALIZAR -->
<?php
//Valida que el usuario hizo clik en el Boton actualizar
if (isset($_POST['actualizar'])) {
  //Trae datos del formulario
  $codigo = $_POST['codigo'];
  $descripcion = $_POST['descripcion'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];


  //Validar que las cajas no esten vacias
  if (!empty($codigo)  && !empty($descripcion) && !empty($price) && !empty($stock)) {
    //Actualizamos los datos en la tabla de la db  
    $sql = $cnnPDO->prepare('UPDATE tabla_imagenes1 SET codigo=:codigo, descripcion=:descripcion, price=:price, stock=:stock  WHERE codigo = :codigo');

    //Asignar las variables a los campos de la tabla
    $sql->bindParam(':codigo', $codigo);
    $sql->bindParam(':descripcion', $descripcion);
    $sql->bindParam(':price', $price);
    $sql->bindParam(':stock', $stock);


    //Ejecutar la variable $sql
    $sql->execute();
    unset($sql);
    unset($cnnPDO);
  }
}
?>

<!-- Códigos de ELIMINAR -->

<?php
//se verifica si se presiona el botón llamado eliminar
if (isset($_POST['eliminar'])) {

  //se guarda en las variables$us y $ps
  $codigo = $_POST['codigo'];

  //Query de consulta
  $query = $cnnPDO->prepare('DELETE from tabla_imagenes1 WHERE codigo =:codigo');

  //Manejo de parámetros
  $query->bindParam(':codigo', $codigo);

  //Execución del query
  $query->execute();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuevo Producto</title>
  <link href="images/A.jpg" rel="icon">
  <style>
    #nax {
      background-color: #027180;
    }
  </style>

</head>


<body>
  <nav id="nax" class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-md">
      <a class="navbar-brand" href="#">Bienvenido </a>
    </div>
    <div class=" offset-9 col-3">
      <a href="cerrar.php" style="letter-spacing: 3px;">
        <button type="button" class="btn btn-outline-danger" data-mdb-ripple-color="dark"> <i class="ace-icon fa fa-power-off"></i></button>
      </a>
    </div>
  </nav>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-5">
        <img src="images/mono.jpg" alt="">
      </div>



      <div class="col-7">
        <h2>Ingresar un producto</h2>
        <form method="POST" enctype="multipart/form-data">
          <!-- 2 column grid layout with text inputs for the first and last names -->
          <div class="row mb-4">
            <div class="col">
              <!--CODIGO-->
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-barcode"></i></span>
                <input type="text" name="codigo" class="form-control" placeholder="Codigo del producto" aria-label="name" aria-describedby="addon-wrapping" value="<?php if (isset($_POST['buscar'])) echo $campo['codigo'] ?>">
              </div>
              <br>
            </div>

            <div class="col">
              <!--DESCRIPCION-->
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-book-open"></i></span>
                <input type="text" name="descripcion" class="form-control" placeholder="Descripcion del producto" aria-label="codigo" aria-describedby="addon-wrapping" value="<?php if (isset($_POST['buscar'])) echo $campo['descripcion'] ?>">
              </div>
              <br>
            </div>

            <div class="container">

              <div>
                <!--PRICE-->
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                  <input type="number" name="price" class="form-control" placeholder="Precio del producto" aria-label="price" aria-describedby="addon-wrapping" value="<?php if (isset($_POST['buscar'])) echo $campo['price'] ?>">
                </div>
                <br>
                <!--STOCK-->
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping"><i class="fas fa-warehouse"></i></span>
                  <input type="text" name="stock" class="form-control" placeholder="Stock" aria-label="descripcion" aria-describedby="addon-wrapping" value="<?php if (isset($_POST['buscar'])) echo $campo['stock'] ?>">
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-cloud-upload-alt"></i> </span>
                  </div>
                  <div class="custom-file">
                    <input type="file" accept="image/jpg" name="imagen" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01" lang="es" value="">
                    <label class="custom-file-label" for="image">Selecciona una imagen (.jpg)</label>
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>



          <div class="row">
            <div class=" col-12">
              <!--BOTONES-->

              <button type="submit" id="enviar" name="enviar" class="btn btn-primary" value="Guardar Imagen"> Registrar</button>
              <button type="submit" id="buscar" name="buscar" class="btn btn-primary">buscar</button>
              <button type="submit" id="actualizar" name="actualizar" class="btn btn-primary">Actualizar</button>
              <button type="submit" id="eliminar" name="eliminar" class="btn btn-primary">Eliminar</i></button>


            </div>
          </div>
          <br>
          <div class=" offset-10 col-2">
            <a href="bienvenida.php" style="letter-spacing: 3px;">
              <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark">Volver</button>
            </a>
          </div>
      </div>
      </form>


    </div> <!-- DIV COL 7 -->
  </div> <!-- DIV ROW -->
  </div>
  </div><!-- DIV CONTAINER -->
  <footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2021 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">Alberto De La Rosa Tovar</a>
    </div>
    <!-- Copyright -->
  </footer>
</body>

</html>