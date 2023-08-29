
<?php
if (strlen(session_id()) < 1)
session_start();
require_once "../modelos/desarrollo-soporte.php";

$desarrollo=new Desarrollo();

$iddesarrollo=isset($_POST["iddesarrollo"])? limpiarCadena($_POST["iddesarrollo"]):"";
$iddet_pag_desarrollo=isset($_POST["iddet_pag_desarrollo"]) ? limpiarCadena(($_POST["iddet_pag_desarrollo"])):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idintegrant_desarrollo=isset($_POST["idintegrant_desarrollo"])? limpiarCadena($_POST["idintegrant_desarrollo"]):"";
$nombre_integrantes=isset($_POST["nombre_integrantes"])? limpiarCadena($_POST["nombre_integrantes"]):"";
$fecha_ingreso=isset($_POST["fecha_ingreso"])? limpiarCadena($_POST["fecha_ingreso"]):"";
$estado_servicio=isset($_POST["estado_servicio"])? limpiarCadena($_POST["estado_servicio"]):"";
$estado_entrega=isset($_POST["estado_entrega"])? limpiarCadena($_POST["estado_entrega"]):"";
$estado_pago=isset($_POST["estado_pago"])? limpiarCadena($_POST["estado_pago"]):"";
$nombre_proyecto=isset($_POST["nombre_proyecto"])? limpiarCadena($_POST["nombre_proyecto"]):"";
$costo_desarrollo=isset($_POST["costo_desarrollo"])? limpiarCadena($_POST["costo_desarrollo"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$monto=isset($_POST["monto"])? limpiarCadena($_POST["monto"]):"";
$saldo=isset($_POST["saldo"])? limpiarCadena($_POST["saldo"]):"";
$tipo_pago=isset($_POST["tipo_pago"])? limpiarCadena($_POST["tipo_pago"]):"";
$idusuario=$_SESSION["idusuario"];


 
switch ($_GET["op"]){
    case 'guardaryeditar':
      if(empty($iddesarrollo)){
        $rspta=$desarrollo->insertar($idcliente,$idusuario,$fecha_ingreso,$estado_servicio,$estado_entrega,$estado_pago,$nombre_proyecto,$costo_desarrollo);
        echo $rspta ? "Servicio Registrado" : "Servicio no se pudo registrar";
      }
      else {
        {
          $rspta=$desarrollo->editar(
            $iddesarrollo,
            $idcliente,
            $estado_servicio,
            $estado_entrega,
            $estado_pago,
            $nombre_proyecto,
            $costo_desarrollo
          );

          echo $rspta ? "Servicio actualizada" : "Servicio no se pudo actualizar";
      }
    }
    break;
    case 'insertarPago':
      $rspta = $desarrollo->insertarPagos($iddesarrollo,$fecha, $monto, $saldo, $tipo_pago);
      echo $rspta ? "Pago registrado" : "No se pudo registrar el pago";
    break;
    
    case 'insertarIntegrante':
      $rspta = $desarrollo->insertarIntegrantes($iddesarrollo,$nombre_integrantes);
      echo $rspta ? "Integrante registrado" : "No se pudo registrarel integrante";
    break;
    /*case 'insertarIntegrante':
      $integrantesArray = $_POST['integrantes'];
      $iddesarrollo = $_POST['iddesarrollo'];
  
      foreach ($integrantesArray as $nombre_integrantes) {
          $rspta = $desarrollo->insertarIntegrantes($iddesarrollo, $nombre_integrantes);
          if (!$rspta) {
              echo "No se pudo registrar los integrantes";
              exit; // Salir del bucle si ocurre un error
          }
      }
  
      echo "Integrantes registrados";
      break;*/


    case 'mostrar':
      $rspta=$desarrollo->mostrar($iddesarrollo);
     
      //codificar el resultado usando json
      echo json_encode($rspta);
      
    break;
    case 'edit':
      $rspta=$desarrollo->edit($iddesarrollo);
     
      //codificar el resultado usando json
      echo json_encode($rspta);
      
    break;

  
    case 'selectCliente':
      require_once "../modelos/Persona.php";
      $persona = new Persona();
      $rspta = $persona->listarcs();
      while ($reg = $rspta->fetch_object())
          {
          echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
          }
    break;
    
    case 'mostrarDatoCliente'://😀
      require_once "../modelos/Persona.php";
      $cliente = new Persona();
      $rspta=$cliente->mostrar($idcliente);
       echo json_encode($rspta);
  
    break;

    case 'selectIntegrante':
      require_once "../modelos/Integrantes_desarrollo.php";
      $integrante= new Integrantes();
      $rspta = $integrante->listarIntegrante();

      while ($reg = $rspta->fetch_object())
          {
          echo '<option value=' . $reg->idintegrant_desarrollo . '>' . $reg->nombre_integrantes . '</option>';
          }
    break;
    case 'selectProyectos':
      $rspta=$desarrollo->listarNombresProyectos();
      while($reg=$rspta->fetch_object()){
        echo '<option value='.$reg->iddesarrollo.'>'.$reg->nombre_proyecto.'</option>';
      }
      break;

    case 'listar':
      $rspta=$desarrollo->listar();
      //Vamos a declarar un array
      $data=Array();
      while($reg=$rspta->fetch_object())
      {
        $data[]=array(
          "0" => '<a class="btn btn-warning" href="../vistas/proceso_desarrollo.php?iddesarrollo='.$reg->iddesarrollo.'"><i class="fa fa-edit"></i></a>'.
          ' <a class="btn btn-danger" onclick="edit('.$reg->iddesarrollo.')"><i class="fa fa-edit"></i></a>'.
            ' <button class="btn btn-success" onclick="mostrar('.$reg->iddesarrollo.')"><i class="fa fa-credit-card"></i></button>',

          "1"=>$reg->fecha_ingreso,
          "2"=>$reg->fecha_ingreso,              
          "3"=>$reg->nombre,
          "4"=>$reg->estado_servicio,
          "5"=>$reg->estado_pago,
          "6"=>$reg->nombre_proyecto,
          "7"=>$reg->costo_desarrollo
        );
      }
      $results= array(
        "sEcho"=>1, //Informacion para el datatable
        "iTotalRecords"=>count($data),//Enviamos el total de registtros en el datatable
        "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
        "aaData"=>$data);
      echo json_encode($results);
    

break;
case 'mostrarPagos':
  $iddesarrollo = $_REQUEST["iddesarrollo"];
  $rspta=$desarrollo->mostrarPagos($iddesarrollo);
 // var_dump($rspta); // Imprimir el objeto para verificar que haya datos
    //Vamos a declarar un array
    //console.log($rspta);
$data= Array();

while ($reg=$rspta->fetch_object()){
    $data[]=array(
        "0"=>$reg->fecha,
        "1"=>$reg->monto,
        "2"=>$reg->saldo,
        "3"=>$reg->tipo_pago,
        "4"=>$reg->iddet_pag_desarrollo
    );
}

$results = array(
  "sEcho"=>1, //Información para el datatables
  "iTotalRecords"=>count($data), //enviamos el total registros al datatable
  "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
  "aaData"=>$data);
echo json_encode($results);
  break;

case 'mostrarIntegrantes':
  $iddesarrollo = $_REQUEST["iddesarrollo"];
  $rspta=$desarrollo->mostrarIntegrantes($iddesarrollo);
 // var_dump($rspta); // Imprimir el objeto para verificar que haya datos
    //Vamos a declarar un array
    //console.log($rspta);
$data= Array();

while ($reg=$rspta->fetch_object()){
    $data[]=array(
        "0"=>$reg->nombre_integrantes,
        "1"=>$reg->iddet_pag_desarrollo
    );
}

$results = array(
  "sEcho"=>1, //Información para el datatables
  "iTotalRecords"=>count($data), //enviamos el total registros al datatable
  "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
  "aaData"=>$data);
echo json_encode($results);
  break;


}

 ?>
