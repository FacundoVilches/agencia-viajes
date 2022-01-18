<?php
    require 'config/config.php';
    // require 'clases/Conexion.php';
    // require 'clases/Region.php';
    $Region = new Region;
    $chequeo = $Region->eliminarRegion();
    $mensaje = "No se pudo eliminar la región";
    $color = "danger";

    if ($chequeo){
        $mensaje = "Región: <b>". $Region->getRegNombre() ."</b> eliminada exitósamente";
        $color = "success";
    }

    include 'includes/over-all-header.html';
    include 'includes/nav.php';
?>

    <main class="container">

        <h1>Baja de una región</h1>

        <div class="alert alert-<?=$color?> col-8 mx-auto">
            <?= $mensaje ?>
            <a href="adminRegiones.php" class="btn btn-light">Volver a panel</a>
        </div>

    </main>

<?php
    include 'includes/footer.php';
?>