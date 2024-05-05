<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <h1> <img src="../../img/tienda.png" alt="" width="100px"> <i class="fa fa-camera-retro"></i> <a href="../Venta/Productos.php">Mi Tiendita</a></h1>

            </div>
            <div class="nav navbar-nav navbar-right">

                <?php if (!isset($_SESSION['user'])) { ?>
                    <!-- Verifica si el usuario está registrado pero no ha iniciado sesión -->
                    <a href="Auth/login.php" class="btn btn-warning"> Login </a>
                <?php } else { ?>
                    <form style="padding-top: 8px;" method="POST" class="header__form" action="../../controllers/CerrarSesion.php">
                        <a class="btn btn-info" href="../Venta/carrito.php">Carrito</a>
                        <input type="submit" value="Cerrar Sesion" class="btn btn-warning">
                    </form>
                <?php }
                ?>

            </div>
        </div>
    </nav>
