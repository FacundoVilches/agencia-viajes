<?php
    require 'config/config.php';
    // require 'clases/Conexion.php';
    // require 'clases/Region.php';
    $Region = new Region;
    $cantDestinos = $Region->confirmarBaja();
    include 'includes/over-all-header.html';
    include 'includes/nav.php';
?>

    <main class="container">
        <h1>Baja de una región</h1>
<?php
    if ($cantDestinos > 0) {
?>
        <div class="alert alert-danger col-6 mx-auto">
            <i class="bi bi-exclamation-triangle"></i>
            No se puede eliminar la región <b><?= $Region->getRegNombre()  ?></b> ya que tiene destinos relacionados
            <br>
            <a href="adminRegiones.php" class="btn btn-light mt-3">
                Volver a panel de regiones
            </a>
        </div>
<?php
    } else {
?>
        <div class="alert bg-light p-4 col-6 mx-auto shadow text-danger">
            Se eliminará la región: <!--<span class="lead">--><b><?= $Region->getRegNombre()  ?></b></span>
            <form action="eliminarRegion.php" method="post">
                <input type="hidden" name="regID" value="<?= $Region->getRegID() ?>">
                <button class="btn btn-danger my-3 px-4">Confirmar baja</button>
                <a href="adminRegiones.php" class="btn btn-outline-secondary">
                    Volver a panel de regiones
                </a>
            </form>
        </div>
        <?php
        }
        ?>

    </main>

<?php  include 'includes/footer.php';  ?>