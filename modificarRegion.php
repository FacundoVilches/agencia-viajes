<?php
    require 'config/config.php';
    // require 'clases/Conexion.php';
    // require 'clases/Region.php';
    $Region = new Region;
    $chequeo = $Region->modificarRegion();
    $mensaje = "No se pudo modificar la región";
    $color = "danger";

    if ($chequeo){
        $mensaje = "Región: <b>". $Region->getRegNombre() ."</b> modificada exitósamente";
        $color = "success";
    }

    include 'includes/over-all-header.html';
    include 'includes/nav.php';
?>

    <main class="container">

        <h1>Modificación de una región</h1>

        <div class="alert alert-<?=$color?> col-8 mx-auto">
            <?= $mensaje ?>
            <a href="adminRegiones.php" class="btn btn-light">Volver a panel</a>
        </div>

    </main>

<?php
    include 'includes/footer.php';
?>