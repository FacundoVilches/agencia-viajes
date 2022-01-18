<?php

    class Conexion
    {
        static $link;
        private function __construct()
        {} //impedimos instanciar la clase

        static function conectar()
        {
            if ( !isset( self::$link ) ){
                self::$link = new PDO(
                    'mysql:host=localhost;dbname=agencia',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
                );
            }
            return self::$link;
        }

        
    }