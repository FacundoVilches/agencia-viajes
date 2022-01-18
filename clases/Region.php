<?php

class Region
{
    private $regID;
    private $regNombre;

    public function listarRegiones()
    {
        $link = Conexion::conectar();
        $sql = "SELECT regID, regNombre
                    FROM regiones";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $regiones = $stmt->fetchAll();
        return $regiones;
    }

    private function cargarDesdeArray($arr){
        $this->setRegID($arr['regID']);
        $this->setRegNombre($arr['regNombre']);
    }

    public function agregarRegion()
    {
        $regNombre = $_POST['regNombre'];
        $link = Conexion::conectar();
        $sql = "INSERT INTO regiones
                    VALUES (DEFAULT, :regNombre)";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':regNombre', $regNombre, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->setRegID($link->lastInsertId());
            $this->setRegNombre($regNombre);
            return $this;
        }
        return false;
    }

    public function verRegionPorID(){
        $regID = $_REQUEST['regID'];
        $link = Conexion::conectar();
        $sql = "SELECT regID, regNombre
                FROM regiones
                WHERE regID = :regID";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(":regID", $regID, PDO::PARAM_INT);
        $stmt->execute();
        $region = $stmt->fetch();
        //Registramos valores de atributos
        $this->cargarDesdeArray($region);
        return $this;
    }

    public function modificarRegion(){
        $regNombre = $_POST['regNombre'];
        $regID = $_POST['regID'];
        $link = Conexion::conectar();
        $sql = "UPDATE regiones
                SET regNombre = :regNombre
                WHERE regID = :regID";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(":regNombre",$regNombre,PDO::PARAM_STR);
        $stmt->bindParam("regID",$regID,PDO::PARAM_INT);
        if ($stmt->execute()){
            $this->setRegNombre($regNombre);
            $this->setRegID($regID);
            return $this;
        }
        return false;
    }

    private function verificarDestinos(){
        $regID = $_GET['regID'];
        $link = Conexion::conectar();
        $sql = "SELECT 1 FROM destinos
                WHERE regID = :regID";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':regID',$regID,PDO::PARAM_INT);
        $stmt->execute();
        $cantidad = $stmt->rowCount();
        return $cantidad;
    }

    public function confirmarBaja(){
        $this->verRegionPorID();
        $cantidad = $this->verificarDestinos();
        // echo $cantidad;
        return $cantidad;
    }

    public function eliminarRegion(){
        $regID = $_POST['regID'];
        $link = Conexion::conectar();
        $this->verRegionPorID();
        $sql = "DELETE FROM regiones
                WHERE regID = :regID";
        $stmt = $link->prepare($sql);
        $stmt->bindParam(':regID',$regID,PDO::PARAM_INT);
        if ($stmt->execute()){
            return $this;
        }
        return false;
    }

    ##############################
    ###  getters && setters
    /**
     * @return mixed
     */
    public function getRegID()
    {
        return $this->regID;
    }

    /**
     * @param mixed $regID
     */
    public function setRegID($regID)
    {
        $this->regID = $regID;
    }

    /**
     * @return mixed
     */
    public function getRegNombre()
    {
        return $this->regNombre;
    }

    /**
     * @param mixed $regNombre
     */
    public function setRegNombre($regNombre)
    {
        $this->regNombre = $regNombre;
    }
}
