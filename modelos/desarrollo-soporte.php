<?php
//Incluimos conexion a la base de trader_cdlrisefall3methods
require "../config/Conexion.php";

Class Desarrollo
{
  //Implementando nuestro constructor
  public function __construct()
  {


  }
  //Implementamos metodo para insertar registro
    public function insertar($idcliente,$idusuario,$fecha_ingreso,$estado_servicio,$estado_entrega,$estado_pago,$nombre_proyecto,$costo_desarrollo)
    {
      $fecha_ingreso = date("Y-m-d"); // Obtener la fecha y hora actual
      $sql="INSERT INTO desarrollo (idcliente,idusuario,fecha_ingreso,estado_servicio,estado_entrega,estado_pago,nombre_proyecto,costo_desarrollo)
      VALUES ('$idcliente','$idusuario','$fecha_ingreso','$estado_servicio','$estado_entrega','$estado_pago','$nombre_proyecto','$costo_desarrollo')";
     return ejecutarConsulta($sql);
   }
    //Implementamos un metodo para editar registro
    public function editar($iddesarrollo,
    $idcliente,
    $estado_servicio,
    $estado_entrega,
    $estado_pago,
    $nombre_proyecto,
    $costo_desarrollo)
    {
      $sql="UPDATE desarrollo SET 
      idcliente='$idcliente',
      estado_servicio='$estado_servicio',
      estado_entrega='$estado_entrega',
      estado_pago='$estado_pago',
      nombre_proyecto='$nombre_proyecto',
      costo_desarrollo='$costo_desarrollo',
      WHERE iddesarrollo='$iddesarrollo'";
      return ejecutarConsulta($sql);
      //var_dump($iddesarrollo);
  }
  public function insertarPagos($iddesarrollo,$fecha, $monto, $saldo, $tipo_pago) {
    $sql_pago = "INSERT INTO det_pag_desarrollo (iddesarrollo,fecha,monto,saldo,tipo_pago)
                 VALUES ('$iddesarrollo','$fecha', '$monto', '$saldo','$tipo_pago')";
    
    return ejecutarConsulta($sql_pago);
}
public function insertarIntegrantes($iddesarrollo,$nombre_integrantes) {
  $sql= "INSERT INTO integrantes_desarrollo (iddesarrollo,nombre_integrantes)
               VALUES ('$iddesarrollo','$nombre_integrantes')";
  return ejecutarConsulta($sql);
}

      public function mostrarPagos($iddesarrollo){
        $sql="SELECT iddesarrollo,fecha,monto,saldo,tipo_pago,iddet_pag_desarrollo FROM det_pag_desarrollo WHERE iddesarrollo='$iddesarrollo'";
        return ejecutarConsulta($sql);
      }
      function mostrarIntegrantes($iddesarrollo) {
        $sql = "SELECT iddesarrollo, nombre_integrantes, idintegrant_desarrollo FROM integrantes_desarrollo WHERE iddesarrollo = '$iddesarrollo'";
        return ejecutarConsulta($sql);
    }
    
   
   
      //Implementamos un metodo para mostrar los datos de un registro a modificar
    public function mostrar($iddesarrollo)
    {
      $sql = "SELECT d.iddesarrollo,d.estado_servicio, d.estado_entrega,d.estado_pago,d.costo_desarrollo,p.nombre,p.num_documento,p.telefono,p.direccion, d.nombre_proyecto, dp.fecha,dp.monto, dp.saldo, dp.tipo_pago
      FROM desarrollo d
      LEFT JOIN persona p ON d.idcliente = p.idpersona
      LEFT JOIN det_pag_desarrollo dp ON d.iddesarrollo = dp.iddesarrollo
      WHERE d.iddesarrollo ='$iddesarrollo'";
      //echo $sql;
      return ejecutarConsultaSimpleFila($sql);

    }
    public function edit($iddesarrollo)
    {
      $sql = "SELECT d.iddesarrollo,d.estado_servicio, d.estado_entrega,d.estado_pago,d.costo_desarrollo,p.nombre,p.num_documento,p.telefono,p.direccion, d.nombre_proyecto, dp.fecha,dp.monto, dp.saldo, dp.tipo_pago
      FROM desarrollo d
      LEFT JOIN persona p ON d.idcliente = p.idpersona
      LEFT JOIN det_pag_desarrollo dp ON d.iddesarrollo = dp.iddesarrollo
      WHERE d.iddesarrollo ='$iddesarrollo'";
      //echo $sql;
      return ejecutarConsultaSimpleFila($sql);

    }
    //Implementar metodo para listar los registros
    public function listar()
    {
      $sql="SELECT d.iddesarrollo,d.estado_servicio,d.estado_pago,d.costo_desarrollo, DATE_FORMAT(d.fecha_ingreso, '%d-%m-%Y') AS fecha_ingreso, 
      d.nombre_proyecto, p.nombre
      FROM desarrollo d
      LEFT JOIN persona p ON d.idcliente = p.idpersona
      ORDER BY d.iddesarrollo DESC" ;
      return ejecutarConsulta($sql);
    }

    public function mostrardesarrollo($iddesarrollo)
    {
      $sql="SELECT d.iddesarrollo,d.nombre_proyecto,d.estado_servicio, d.estado_pago,dp.fecha, dp.monto, dp.saldo,dp.tipo_pago,  i.nombre_integrantes as integrante, d.garantia_desarrollo
       FROM desarrollo d
       left JOIN integrantes_desarrollo i ON d.iddesarrollo = i.iddesarrollo
       INNER JOIN persona p ON d.idcliente = p.idpersona
       LEFT JOIN det_pag_desarrollo dp ON d.iddesarrollo=dp.iddesarrollo
       where d.iddesarrollo='$iddesarrollo'";
      //echo $sql;
      return ejecutarConsulta($sql);

    }

    /*public function mostrarDatoCliente($id){
      $sql="SELECT * from persona WHERE idpersona = '$id'";
      return ejecutarConsultaSimpleFila($sql);
  
    }*/

    public function pagodesarrollo($iddesarrollo){
      $sql="SELECT fecha,monto,saldo,tipo_pago
      FROM det_pag_desarrollo
      WHERE iddesarrollo='$iddesarrollo'";
      return ejecutarConsulta($sql);
    }
  
    public function listarNombresProyectos()
    {
        $sql = "SELECT nombre_proyecto FROM de  sarrollo";
        
        // Ejecuta la consulta utilizando tu función ejecutarConsulta y devuelve el resultado.
        return ejecutarConsulta($sql);
    }
    
  }

 ?>
