<?php
session_start();
if ($_SESSION['user'] == "") {
    header('Location: ../Auth/Login.php');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
</head>

<body>

<?php include '../Layout/Layout.php'; ?>
    <div class="container">
        <div class="jumbotron">
            <p>Verfica tus productos</p>
        </div>


        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sumaTotal=0;
                $leer = fopen('../../controllers/carrito.txt', 'r');
                while (!feof($leer)) {
                    $clave_doc = fgets($leer);
                    $nombre_doc = fgets($leer);
                    $imagen_doc = fgets($leer);
                    $cantidad_doc = floatval(fgets($leer));
                    $precio_doc = floatval(fgets($leer));
                    $precioTotal = $cantidad_doc * $precio_doc;
                    $sumaTotal += $precioTotal;
                    if ($clave_doc != null) {
                ?>
                        <tr>
                            <td><?php echo $nombre_doc ?></td>
                            <td><img src="../../controllers/files/<?php echo $clave_doc ?>/<?php echo $imagen_doc ?>" width="100px" alt="<?php echo $nombre_doc ?>"></td>
                            <td> <?php echo $precio_doc ?></td>
                            <td>$ <?php echo $cantidad_doc ?></td>
                            <td>$ <?php echo $precioTotal ?></td>
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
        </table>

        <div class="container mt-3" >
        <div class=" d-md-flex justify-content-md-end">
            <p class=" fs-2" >Total: $  <?php echo $sumaTotal ?></p>
            <div>
            <a style="margin-left: 800px;" href="../../controllers/Ventas.php" class="btn btn-warning">Comprar</a>
            </div>
        </div>
        </div>



</body>

<!-- JQuery CDN -->
<script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<!-- JavaScript Bootstrap CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>