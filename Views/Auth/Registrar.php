<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registrar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body <?php if(isset($_REQUEST['error']) && $_REQUEST['error']) { ?>
    onload="isPageFullyLoaded()"
<?php } ?>>
    <section class="vh-120" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../../img/teinda_fondo.jpg" alt="login form" class="" style="border-radius: 1rem 0 0 1rem;" height="850px" width="480px" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">


                                    <form action="../../controllers/GuardarRegistro.php" method="POST" onsubmit="return validacion()">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>

                                            <img src="../../img/tienda.png" alt="login form" class="img-fluid" width="100px" />
                                            <span class="h1 fw-bold mb-0">Mi Tiendita</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registra Tu cuenta</h5>


                                        <div class="form-outline mb-4">
                                            <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" />
                                            <label class="form-label" for="nombre">Nombre</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="apellido" name="apellido" class="form-control form-control-lg" />
                                            <label class="form-label" for="apellido">Apellido</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="correo" name="correo" class="form-control form-control-lg" />
                                            <label class="form-label" for="correo">Correo</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="contraseña"  name="contraseña"class="form-control form-control-lg" />
                                            <label class="form-label" for="contraseña">Contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Registrar</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">¿Ya tienes una cuenta? <a href="Login.php" style="color: #393f81;">Inicia Sesion Ahora</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function validacion() {
        nombre = document.getElementById("nombre");
        apellidos = document.getElementById("apellido");
        correo = document.getElementById("correo");
        contraseña = document.getElementById("contraseña");
        console.log(nombre);

        if (nombre.value != "" && apellidos.value != "" && correo.value != "" && contraseña.value != "") {
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
                text: 'Error el Usuario ya Existe',
               
            })
        }
</script>

</html>