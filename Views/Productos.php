<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

</head>



<body <?php if(isset($_REQUEST['error']) && $_REQUEST['error']) { ?>
    onload="isPageFullyLoaded()"
<?php } ?>><!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav-demo" aria-expanded="false">
                    <span class="sr-only"> Toggle navigation </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="Productos.php" class="navbar-brand"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> MiTiendita</a>

            </div>
            <div class="collapse navbar-collapse" id="bs-nav-demo">

                <ul class="nav navbar-nav navbar-right">

                    <?php if ($_SESSION['user'] == "") { ?>

                        <li><a href="Auth/login.php" class="btn btn-light"> Login </a></li>
                    <?php } else { ?>
                        <li><a class="btn btn-light" href="Venta/carrito.php">Carrito</a></li>
                        <li>
                            <form style="padding-top: 8px;" method="POST" class="header__form" action="../controllers/CerrarSesion.php">
                                <input type="submit" value="Cerrar Sesion" class="btn btn-outline-secondary">
                            </form>
                        </li>
                    <?php }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron">

            <h1> <img src="../img/tienda.png" alt="" width="100px"> <i class="fa fa-camera-retro"></i> Mi Tiendita</h1>
            <p>Selecciona tus Productos Favoritos</p>
        </div>

        <div class="row">

            <?php $leer = fopen('../controllers/productos.txt', 'r');
            while (!feof($leer)) {
                $clave_doc = fgets($leer);
                $nombre_doc = fgets($leer);
                $imagen_doc = fgets($leer);
                $precio_doc = fgets($leer);
                $cantidad_doc = fgets($leer);
                if ($clave_doc != null) { ?>

                    <div class="col-lg-4 col-sm-6">
                        <div class="thumbnail">
                            <img src="../controllers/files/<?php echo $clave_doc ?>/<?php echo $imagen_doc ?> " />
                            <div class="p-4">
                                <h3> <?php echo $nombre_doc ?></h3>
                                <p>Disponible: <?php echo $cantidad_doc ?></p>
                                <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                    <h4>Precio: $ <?php echo $precio_doc ?></h4>
                                </div>
                                <form action="../controllers/AgregarCarrito.php" method="Post" >
                                    <input type="hidden" name="clave" value="<?php echo $clave_doc ?>">
                                    <input type="number" id="cantidad" name="cantidad" value="1" min="1"  oninput="this.value = Math.max(this.value, 1) " >
                                    <button class="btn btn-warning" type="submit">Agregar al Carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>




        </div>
    </div>
</body>
<!-- JQuery CDN -->
<script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<!-- JavaScript Bootstrap CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

function isPageFullyLoaded() {
        Swal.fire({
            icon: 'success',
            title: 'Agregado',
            text: 'El Producto fue Agregado al Carrito',

        })
    }

</script>

</html>