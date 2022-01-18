<?php

class Destino {
    
    private $destID;
    private $destNombre;
    private $regID;
    static $regNombre;
    private $destPrecio;
    private $destAsientos;
    private $destDisponibles;
    private $destActivo;

    public function listarDestinos(){
        $link = Conexion::conectar();
        $sql =  "SELECT destID,
                        destNombre,
                        d.regID,
                        regNombre,
                        destPrecio,
                        destAsientos,
                        destDisponibles
                FROM destinos d, regiones r
                WHERE d.regID = r.regID";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $destinos = $stmt->fetchAll();
        return $destinos;
    }

    ########################

    public function agregarDestino(){
        $destNombre = $_POST['destNombre'];
        $regID = $_POST['regID'];
        $destPrecio = $_POST['destPrecio'];
        $destAsientos = $_POST['destAsientos'];
        $destDisponibles = $_POST['destDisponibles'];
        $link = Conexion::conectar();
        $sql = "INSERT INTO destinos
                ( destNombre, regID, destPrecio, destAsientos, destDisponibles )
                VALUES ( :destNombre, :regID, :destPrecio, :destAsientos, :destDisponibles)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':destNombre', $destNombre, PDO::PARAM_STR);
        $stmt->bindParam(':regID', $regID, PDO::PARAM_INT);
        $stmt->bindParam(':destPrecio', $destPrecio, PDO::PARAM_INT);
        $stmt->bindParam(':destAsientos', $destAsientos, PDO::PARAM_INT);
        $stmt->bindParam(':destDisponibles', $destDisponibles, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $this->setDestID($link->lastInsertId());
            $this->setDestNombre($destNombre);
            $this->setRegID($regID);
            $this->setDestPrecio($destPrecio);
            $this->setDestAsientos($destAsientos);
            $this->setDestDisponibles($destDisponibles);
            $this->setDestActivo(1);//default
            return $this;
        }
        return false;
    }

    private function cargarDatosDesdeArray($arr){
        $this->setDestID($arr['destID']);
        $this->setDestNombre($arr['destNombre']);
        $this->setRegID($arr['regID']);
        self::setRegNombre($arr['regNombre']);
        $this->setDestPrecio($arr['destPrecio']);
        $this->setDestAsientos($arr['destAsientos']);
        $this->setDestDisponibles($arr['destDisponibles']);
        $this->setDestActivo(1);
    }

    public function verDestinoPorID(){
        $destID = $_REQUEST['destID'];
        $link = Conexion::conectar();
        $sql = "SELECT destID,
                    destNombre,
                    d.regID,
                    regNombre,
                    destPrecio,
                    destAsientos,
                    destDisponibles
                FROM destinos d, regiones r
                WHERE d.regID = r.regID
                AND destID = :destID";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':destID',$destID);
        $stmt->execute();
        $destino = $stmt->fetch();
        $this->cargarDatosDesdeArray($destino);
        return $this;
    }

        public function modificarDestino(){
            $destNombre = $_POST['destNombre'];
            $regID = $_POST['regID'];
            $destPrecio = $_POST['destPrecio'];
            $destAsientos = $_POST['destAsientos'];
            $destDisponibles = $_POST['destDisponibles'];
            $destID = $_POST['destID'];
            $link = Conexion::conectar();
            $sql = "UPDATE destinos
                    SET destNombre = :destNombre,
                        regID = :regID,
                        destPrecio = :destPrecio,
                        destAsientos = :destAsientos,
                        destDisponibles = :destDisponibles
                    WHERE destID = :destID";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':destNombre', $destNombre, PDO::PARAM_STR);
            $stmt->bindParam(':regID', $regID, PDO::PARAM_INT);
            $stmt->bindParam(':destPrecio', $destPrecio, PDO::PARAM_INT);
            $stmt->bindParam(':destAsientos', $destAsientos, PDO::PARAM_INT);
            $stmt->bindParam(':destDisponibles', $destDisponibles, PDO::PARAM_INT);
            $stmt->bindParam(':destID', $destID, PDO::PARAM_INT);
            if ($stmt->execute()){
                $this->setDestID($destID);
                $this->setDestNombre($destNombre);
                $this->setRegID($regID);
                $this->setDestPrecio($destPrecio);
                $this->setDestAsientos($destAsientos);
                $this->setDestDisponibles($destDisponibles);
                $this->setDestActivo(1);//default
                return $this;
            }
            return false;
        }

        public function eliminarDestino(){
            $destID = $_POST['destID'];
            $link = Conexion::conectar();
            $this->verDestinoPorID();
            $sql = "DELETE FROM destinos
                    WHERE destID = :destID";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':destID',$destID,PDO::PARAM_INT);
            if ($stmt->execute()){
                return $this;
            }
            return false;
        }

    /**
     * Get the value of destID
     */ 
    public function getDestID()
    {
        return $this->destID;
    }

    /**
     * Set the value of destID
     *
     * @return  self
     */ 
    public function setDestID($destID)
    {
        $this->destID = $destID;

        return $this;
    }

    /**
     * Get the value of destNombre
     */ 
    public function getDestNombre()
    {
        return $this->destNombre;
    }

    /**
     * Set the value of destNombre
     *
     * @return  self
     */ 
    public function setDestNombre($destNombre)
    {
        $this->destNombre = $destNombre;

        return $this;
    }

    /**
     * Get the value of regID
     */ 
    public function getRegID()
    {
        return $this->regID;
    }

    /**
     * Set the value of regID
     *
     * @return  self
     */ 
    public function setRegID($regID)
    {
        $this->regID = $regID;

        return $this;
    }

    /**
     * Get the value of destPrecio
     */ 
    public function getDestPrecio()
    {
        return $this->destPrecio;
    }

    /**
     * Set the value of destPrecio
     *
     * @return  self
     */ 
    public function setDestPrecio($destPrecio)
    {
        $this->destPrecio = $destPrecio;

        return $this;
    }

    /**
     * Get the value of destAsientos
     */ 
    public function getDestAsientos()
    {
        return $this->destAsientos;
    }

    /**
     * Set the value of destAsientos
     *
     * @return  self
     */ 
    public function setDestAsientos($destAsientos)
    {
        $this->destAsientos = $destAsientos;

        return $this;
    }

    /**
     * Get the value of destDisponibles
     */ 
    public function getDestDisponibles()
    {
        return $this->destDisponibles;
    }

    /**
     * Set the value of destDisponibles
     *
     * @return  self
     */ 
    public function setDestDisponibles($destDisponibles)
    {
        $this->destDisponibles = $destDisponibles;

        return $this;
    }

    /**
     * Get the value of destActivo
     */ 
    public function getDestActivo()
    {
        return $this->destActivo;
    }

    /**
     * Set the value of destActivo
     *
     * @return  self
     */ 
    public function setDestActivo($destActivo)
    {
        $this->destActivo = $destActivo;

        return $this;
    }

    /**
     * Get the value of regNombre
     */ 
    static function getRegNombre()
    {
        return self::$regNombre;
    }

    /**
     * Set the value of regNombre
     *
     * @return  self
     */ 
    static function setRegNombre($regNombre)
    {
        self::$regNombre = $regNombre;
    }
}

?>