<?php
    require 'config/config.php';
    // require 'clases/Conexion.php';
    // require 'clases/Destino.php';
    $Destino = new Destino;
    $chequeo = $Destino->eliminarDestino();
    $mensaje = "No se pudo eliminar el destino";
    $color = "danger";

    if ($chequeo){
        $mensaje = "Destino: <b>". $Destino->getDestNombre() ."</b> eliminado exitósamente";
        $color = "success";
    }

    include 'includes/over-all-header.html';
    include 'includes/nav.php';
?>

    <main class="container">

        <h1>Baja de un destino</h1>

        <div class="alert alert-<?=$color?> col-8 mx-auto">
            <?= $mensaje ?>
            <a href="adminDestinos.php" class="btn btn-light">Volver a panel</a>
        </div>

    </main>

<?php
    include 'includes/footer.php';
?>