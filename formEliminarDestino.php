<?php

    require 'config/config.php';
    // require 'clases/Conexion.php';
    // require 'clases/Destino.php';
    $Destino = new Destino;
    $Destino->verDestinoPorID();
    include 'includes/over-all-header.html';
    include 'includes/nav.php';
?>
    
    <main class="container">
            <h1>Baja de un destino</h1>

            <div class="alert bg-light p-4 col-6 mx-auto shadow text-danger">
            Se eliminará la región: <!--<span class="lead">--><b><?= $Destino->getDestNombre()  ?></b></span>
            <form action="eliminarDestino.php" method="post">
                <input type="hidden" name="destID" value="<?= $Destino->getDestID() ?>">
                <button class="btn btn-danger my-3 px-4">Confirmar baja</button>
                <a href="adminDestinos.php" class="btn btn-outline-secondary">
                    Volver a panel de regiones
                </a>
            </form>
        </div>

    </main>
<?php
    include 'includes/footer.php';
?>