<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Venta_mensual.php";

$venta=new Venta2();

switch ($_GET["op"]){
case 'selectUsuario':
		require_once "../modelos/Usuario.php";
		$usuario = new Usuario();
		$rspta=$usuario->listar();
		$html = '';
		$html .= '<option value="all">Todos</option>';
		while ($reg=$rspta->fetch_object()) {
			$html .= '<option value='.$reg->idusuario.'>'.$reg->nombre.'</option>';
		}
		echo $html;
	break;

    case 'ventasFechaUsuarioNC':
    
        require_once "../modelos/Consultas2.php";
        $consulta=new Consultas();
        $fecha_inicio=$_REQUEST['fecha_inicio'];
        $fecha_fin=$_REQUEST['fecha_fin'];
        $idusuario=$_REQUEST['idusuario'];
        $rspta=$consulta->ventasfechausuarioNC($fecha_inicio,$fecha_fin,$idusuario);
        $data=Array();
        while ($reg=$rspta->fetch_object()) {
          $data[]=array(
              "0"=>$reg->fecha,
              "1"=>$reg->descripcion_tipo_comprobante,
              "2"=>$reg->serie.' - '.$reg->correlativo,
              "3"=>$reg->serie_rela.' - '.$reg->correlativo_rela,
              "4"=>$reg->motivo,
              "5"=>$reg->total_venta,
              // "6"=>$reg->impuesto,
              "6"=>('Anulado')?'<span class="label bg-green">Aceptado<span>':'<span class="label bg-red">Anulado<span>'
    
          );
        }
        $results=array(
          "isEcho"=>1,
          "iTotalRecords"=>count($data),
          "iTotalDisplayRecords"=>count($data),
          "aaData"=>$data
        );
    
        echo json_encode($results);
    
        break;

        case 'sumVentasFechaUsuarioNC':
            require_once "../modelos/Consultas2.php";
            $consulta=new Consultas();
            $fecha_inicio=$_REQUEST['fecha_inicio'];
            $fecha_fin=$_REQUEST['fecha_fin'];
            $idusuario=$_REQUEST['idusuario'];
            $rspta=$consulta->sumventasfechausuarioNC($fecha_inicio,$fecha_fin,$idusuario);
            echo json_encode($rspta);
          break;
}
?>