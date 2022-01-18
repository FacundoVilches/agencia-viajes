<?php
    require 'config/config.php';
    // require 'clases/Conexion.php';
    // require 'clases/Destino.php';
    $Destino = new Destino;
    $chequeo = $Destino->agregarDestino();
    $mensaje = "No se pudo agregar el destino";
    $color = "danger";

    if ($chequeo){
        $mensaje = "Destino: <b>". $Destino->getDestNombre() ."</b> agregado exitósamente";
        $color = "success";
    }

    include 'includes/over-all-header.html';
    include 'includes/nav.php';
?>

    <main class="container">

        <h1>Alta de una destino</h1>

        <div class="alert alert-<?=$color?> col-8 mx-auto">
            <?= $mensaje ?>
            <a href="adminDestinos.php" class="btn btn-light">Volver a panel</a>
        </div>

    </main>

<?php
    include 'includes/footer.php';
?>