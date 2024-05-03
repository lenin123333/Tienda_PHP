<?php 
session_start();
if($_SESSION['admin']==""){
    header('Location: ../Productos.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
</head>

<body <?php if(isset($_REQUEST['error']) && $_REQUEST['error']) { ?>
    onload="isPageFullyLoaded()"
<?php } ?>>




    <div style="width: 900px;   margin: 0 auto;">
        <h2 style="padding-top: 5rem;">Registrar Productos</h2>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding:1rem;">

            <a class="btn btn-primary" href="Productos_Admin.php ">Regresar</a>
        </div>
        <div class="container-fluid">
            <form action="../../controllers/RegistrarProducto.php" method="POST" enctype="multipart/form-data" onsubmit="return Validacion()">

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="clave" name="clave" class="form-control" />
                    <label class="form-label" for="clave">Clave Producto</label>
                </div>

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="nombre" name="nombre" class="form-control" />
                    <label class="form-label" for="nombre">Nombre Producto</label>
                </div>

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="file" name="imagen" accept="image/jpg" required>
                    <label class="form-label" for="imagen">Foto Producto</label>
                </div>
                
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="precio" name="precio" class="form-control" />
                    <label class="form-label" for="precio">Precio Producto</label>
                </div>

                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input type="text" id="cantidad" name="cantidad" class="form-control" />
                    <label class="form-label" for="cantidad">Cantidad Producto</label>
                </div>



                <!-- Submit button -->
                <button type="submit" class="btn btn-primary ">Guardar</button>

            </form>
        </div>
    </div>

</body>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function Validacion() {

        clave = document.getElementById("clave");
        nombre = document.getElementById("nombre");
        precio = document.getElementById("precio");
        cantidad = document.getElementById("cantidad");


        if (clave.value != "" && nombre.value != "" && precio.value != "" && cantidad.value != "") {
            return true;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Faltan Campos Por Llenar',

            })
            return false;
        }
    }

    function isPageFullyLoaded() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error la Clave del Producto ya Existe',

        })
    }
</script>

</html>