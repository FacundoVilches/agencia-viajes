<?php

    #### configuración general de sistema  ####
    session_start();

    //función de autocarga
    function autoload( $Clase ){
        require_once 'clases/'.$Clase.'.php';
    }
    spl_autoload_register('autoload');


    function mostrar($dato)
    {
        echo '<pre>';
        print_r($dato);
        echo '</pre>';
    }