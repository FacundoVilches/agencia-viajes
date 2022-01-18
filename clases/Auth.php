<?php

    class Auth
    {
        static $usuario;
        static $email;
        static $idRol;

        static function login()
        {
            $nombre = $_POST['nombre'];
            $clave   = $_POST['clave'];

            $link = Conexion::conectar();
            $sql = "SELECT nombre, email, idRol, password
                    FROM usuarios
                    WHERE nombre = :nombre";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            if ( $stmt->rowCount() ) {
                $datos = $stmt->fetch(PDO::FETCH_ASSOC);
                //info($datos);
                if ( password_verify( $clave, $datos['password'] )){
                    self::setUsuario( $nombre);
                    $_SESSION['nombre'] = self::getUsuario();
                    self::setEmail( $datos['email'] );
                    $_SESSION['email'] = self::getEmail();
                    self::setIdRol( $datos['idRol'] );
                    $_SESSION['idRol'] = $datos['idRol'];
                    header('location: usuarios.php');
                }
                else{
                    header('location: fLogin.php?error=1');
                }
            }else{
                header('location: fLogin.php?error=1');
            }
        }

        static function logout()
        {
            self::setUsuario( 'null' );
            unset($_SESSION['nombre']);
            self::setEmail( 'null' );
            unset($_SESSION['email']);
            self::setIdRol( 'null' );
            unset($_SESSION['idRol']);
            header( 'location: fLogin.php');
        }

        static function check()
        {
            if( isset( $_SESSION['nombre'] ) ){
                self::setUsuario( $_SESSION['nombre'] );
                self::setEmail( $_SESSION['email'] );
                self::setIdRol( $_SESSION['idRol'] );
                return true;
            }
            //header('location: fLogin.php?error=2');
            return false;
        }

    ############################################
        ###      getters & setters      ###

        public static function getUsuario()
        {
            return self::$usuario;
        }
        public static function setUsuario($usuario): void
        {
            self::$usuario = $usuario;
        }

        public static function getEmail()
        {
            return self::$email;
        }
        public static function setEmail($email): void
        {
            self::$email = $email;
        }

        public static function getIdRol()
        {
            return self::$idRol;
        }
        public static function setIdRol($idRol): void
        {
            self::$idRol = $idRol;
        }
    }