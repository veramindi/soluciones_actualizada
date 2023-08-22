<?php
require "../config/Conexion.php";

Class Integrantes{
    public function __construct()
    {

    }

    public function insertar($nombre_integrantes){
        $sql="INSERT INTO integrantes_desarrollo (nombre_integrantes) VALUES ('$nombre_integrantes')";
        return ejecutarConsulta($sql);
    }

    public function editar($idintegrant_desarrollo,$nombre_integrantes)
    {
      $sql="UPDATE 
              integrantes_desarrollo
            SET 
              nombre_integrantes='$nombre_integrantes',
            where 
            idintegrant_desarrollo='$idintegrant_desarrollo'";
      return ejecutarConsulta($sql);
    }


    public function listarIntegrante(){
        $sql="SELECT * FROM integrantes_desarrollo";
        return ejecutarConsulta($sql);
    }

    public function eliminar($idintegrant_desarrollo){
        $sql="DELETE FROM integrantes_desarrollo WHERE idintegrant_desarrollo='$idintegrant_desarrollo'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idintegrant_desarrollo)
    {
      $sql="SELECT * FROM integrantes_desarrollo where idintegrant_desarrollo='$idintegrant_desarrollo'";
      return ejecutarConsultaSimpleFila($sql);

    }

}

?>