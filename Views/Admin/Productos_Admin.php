<?php

session_start();
if ($_SESSION['admin'] == "") {
   header('Location: ../Productos.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
</head>

<body>

  <div class="container mt-3">
    <h2>Prouctos</h2>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

      <a class="btn btn-info" href="Agregar_Productos.php" style="color:azure; ">Agregar Productos</a>
      <form method="POST" class="header__form" action="../../controllers/CerrarSesion.php">
        <input type="submit" value="Cerrar Sesion" class="btn btn-warning">
      </form>

    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Imagen</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $leer = fopen('../../controllers/productos.txt', 'r');
        while (!feof($leer)) {
          $clave_doc = fgets($leer);
          $nombre_doc = fgets($leer);
          $imagen_doc = fgets($leer);
          $precio_doc = fgets($leer);
          $cantidad_doc = fgets($leer);
          if ($clave_doc != null) {
        ?>

            <tr>
              <td><?php echo $nombre_doc ?></td>
              <td><img src="../../controllers/files/<?php echo $clave_doc ?>/<?php echo $imagen_doc ?>" width="100px" alt="<?php echo $nombre_doc ?>"></td>
              <td><?php echo $precio_doc ?></td>
              <td><?php echo $cantidad_doc ?></td>
              <td><a href="ModificarProducto.php?clave=<?php echo $clave_doc ?>" class="btn btn-primary ">Modificar</a></td>
              <td>
                <form method="post" action="../../controllers/EliminarProductos.php">
                  <input type="hidden" name="clave" value=" <?php echo $clave_doc ?> ">
                  <button type="submit" class="btn btn-danger">
                    Eliminar
                  </button>
                </form>
              </td>
            </tr>


        <?php }
        }

        ?>

      </tbody>
    </table>
  </div>

</body>

</html>