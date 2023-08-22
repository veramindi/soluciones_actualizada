<?php
//Incluimos conexion a la base de trader_cdlrisefall3methods
require "../config/Conexion.php";

Class Soporte 
{
  //Implementando nuestro constructor
  public function __construct()
  {


  }
  //Implementamos metodo para insertar registro
    public function insertar($codigo_soporte,$nombre_cliente,$telefono,$tecnico_respon,$fecha_ingreso,$fecha_salida,$marca,$problema,$solucion,$tipo_equipo,$estado_servicio,$estado_pago,$total,$estado_entrega,$direccion,$accesorio,$recomendacion,$garantia)
    {
      $sql="INSERT INTO soporte (codigo_soporte,nombre_cliente,telefono,tecnico_respon,fecha_ingreso,fecha_salida,marca,problema,solucion,tipo_equipo,estado_servicio,estado_pago,total,estado_entrega,direccion,accesorio,recomendacion,garantia)
      VALUES ('$codigo_soporte','$nombre_cliente','$telefono','$tecnico_respon','$fecha_ingreso','$fecha_salida','$marca','$problema','$solucion','$tipo_equipo','$estado_servicio','$estado_pago','$total','$estado_entrega','$direccion','$accesorio','$recomendacion','$garantia')";
     return ejecutarConsulta($sql);
   }
    //Implementamos un metodo para editar registro
    public function editar($idsoporte,$nombre_cliente,$telefono,$tecnico_respon,$fecha_ingreso,$fecha_salida,$marca,$problema,$solucion,$tipo_equipo,$codigo_soporte,$estado_servicio,$estado_pago,$total,$estado_entrega,$direccion,$accesorio,$recomendacion,$garantia)//,,$idsoporten,$idusuario,$fecha_pago, $cuotas, $saldos, $tipo_pago
    {
      $sql="UPDATE soporte SET 
      nombre_cliente='$nombre_cliente',
      telefono='$telefono',
      tecnico_respon='$tecnico_respon',
      fecha_ingreso='$fecha_ingreso',
      fecha_salida='$fecha_salida',
      marca='$marca',
      solucion='$solucion',
      problema='$problema',
      tipo_equipo='$tipo_equipo',
      codigo_soporte='$codigo_soporte' ,
      estado_servicio='$estado_servicio',
      estado_pago='$estado_pago',
      total='$total',
      estado_entrega='$estado_entrega',
      direccion='$direccion',
      accesorio='$accesorio',
      recomendacion='$recomendacion',
      garantia='$garantia' 
      WHERE idsoporte='$idsoporte'";
      return ejecutarConsulta($sql);
      //var_dump($idsoporte);
  }
  public function insertarPagos($nombre_cliente, $idsoporte, $idusuario, $fecha_pago, $cuotas, $saldos, $tipo_pago) {
    $sql_pago = "INSERT INTO soporte_pago (idcliente, idsoporte, idusuario, fecha_pago, cuota, saldo, tipo_pago)
                 VALUES ('$nombre_cliente', '$idsoporte', '$idusuario', '$fecha_pago', '$cuotas', '$saldos', '$tipo_pago')";
    
    return ejecutarConsulta($sql_pago);
}
    //Implementamos un metodo para eliminar registro
    public function eliminar($idcodigo)
    {
      $sql="DELETE FROM soporte where idsoporte='$idcodigo'";
      //echo $sql;
      ejecutarConsulta($sql);
    }
    public function mostrarPagos($idsoporte){
      $sql="SELECT idsoporte,fecha_pago,cuota,saldo,tipo_pago,idsoportepago FROM soporte_pago WHERE idsoporte='$idsoporte'";
      return ejecutarConsulta($sql);
    }

   


      //Implementamos un metodo para mostrar los datos de un registro a modificar
    public function mostrar($idsoporte)
    {
      $sql="SELECT s.idsoporte,s.fecha_ingreso,s.nombre_cliente, s.tipo_equipo, s.estado_servicio, s.estado_entrega, s.estado_pago, s.tecnico_respon, s.solucion, s.marca,s.problema, s.total, sp.cuota, sp.saldo, s.fecha_ingreso, s.direccion, s.accesorio, s.recomendacion, s.garantia, p.nombre, p.telefono , p.direccion, s.codigo_soporte,s.fecha_salida,t.nombre as tecnico, p.nombre as cliente, p.telefono as telefono, sp.fecha_pago, sp.tipo_pago
       FROM soporte s
       left JOIN tecnico t ON s.tecnico_respon=t.idtecnico
       LEFT JOIN persona p ON s.nombre_cliente=p.idpersona
       LEFT JOIN soporte_pago sp ON s.idsoporte=sp.idsoporte
       where s.idsoporte='$idsoporte'";
      //echo $sql;
      return ejecutarConsultaSimpleFila($sql);

    }

    //Implementar metodo para listar los registros
    public function listar()
    {
      $sql="SELECT s.idsoporte,s.fecha_ingreso,s.nombre_cliente, s.tipo_equipo, s.estado_servicio, s.estado_entrega, s.estado_pago, s.tecnico_respon, s.solucion, s.marca, s.telefono,s.problema, s.total, s.cuota, s.saldo, s.fecha_ingreso, s.direccion, s.accesorio, s.recomendacion, s.garantia, p.nombre ,t.nombre as tecnico
      FROM soporte s
      left JOIN tecnico t ON s.tecnico_respon=t.idtecnico
      INNER JOIN persona p ON s.nombre_cliente=p.idpersona order by s.idsoporte desc" ;
      return ejecutarConsulta($sql);
    }

    public function mostrarSoporte($idsoporte)
    {
      $sql="SELECT s.idsoporte,s.fecha_ingreso,s.nombre_cliente, s.tipo_equipo, s.estado_servicio, s.estado_entrega, s.estado_pago, s.tecnico_respon, s.solucion, s.marca,s.problema, s.total, sp.cuota, sp.saldo, s.fecha_ingreso, s.direccion, s.accesorio, s.recomendacion, s.garantia, p.nombre, p.telefono , p.direccion, s.codigo_soporte,s.fecha_salida,t.nombre as tecnico, p.nombre as cliente, p.telefono as telefono, sp.fecha_pago, sp.tipo_pago
       FROM soporte s
       left JOIN tecnico t ON s.tecnico_respon=t.idtecnico
       LEFT JOIN persona p ON s.nombre_cliente=p.idpersona
       LEFT JOIN soporte_pago sp ON s.idsoporte=sp.idsoporte
       where s.idsoporte='$idsoporte'";
      //echo $sql;
      return ejecutarConsulta($sql);

    }

    /*public function mostrarDatoCliente($id){
      $sql="SELECT * from persona WHERE idpersona = '$id'";
      return ejecutarConsultaSimpleFila($sql);
  
    }*/

    public function pagoSoporte($idsoporte){
      $sql="SELECT cuota,saldo,fecha_pago,tipo_pago
      FROM soporte_pago
      WHERE idsoporte='$idsoporte'";
      return ejecutarConsulta($sql);
    }
  
  


  }







 ?>
