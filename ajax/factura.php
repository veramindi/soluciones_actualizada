<?php
if (strlen(session_id()) < 1)
  session_start();

require_once "../modelos/Factura.php";
 

$factura=new Factura();

$id_factura=isset($_POST["id_factura"])? limpiarCadena($_POST["id_factura"]):"";
$idusuario=$_SESSION["idusuario"];
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$codigotipo_pago=isset($_POST["codigotipo_pago"])? limpiarCadena($_POST["codigotipo_pago"]):"";
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$fecha_ven=isset($_POST["fecha_ven"])? limpiarCadena($_POST["fecha_ven"]):"";
$serie=isset($_POST["serie"])? limpiarCadena($_POST["serie"]):"";
$correlativo=isset($_POST["correlativo"])? limpiarCadena($_POST["correlativo"]):"";
// $fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$moneda=isset($_POST["moneda"])? limpiarCadena($_POST["moneda"]):"";
$impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";
$impuesto=($impuesto*(1/100));
// $impuesto=isset($_POST["impuesto"])? limpiarCadena($_POST["impuesto"]):"";

$op_gravadas=isset($_POST["op_gravadas"])? limpiarCadena($_POST["op_gravadas"]):"";
$igv_total=isset($_POST["igv_total"])? limpiarCadena($_POST["igv_total"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";

// $fecha_hora = date('Y-m-d H:i:s');

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_factura)){
			require_once "../reportes/NumeroALetras.php";
			$letras = NumeroALetras::convertir($total_venta);
			list($num,$cen)=explode('.',$total_venta);
			$leyenda= $letras.'Y '.$cen.' /100 SOLES';

			$rspta=$factura->insertar($idusuario,$idcliente,$tipo_comprobante,$codigotipo_pago,$serie,$correlativo,$fecha_hora,$fecha_ven,$moneda,$impuesto,$op_gravadas,$igv_total,$total_venta,$leyenda,$_POST["codigo_prod"],$_POST["descripcion_prod"],$_POST["unidad_medida"],$_POST["cantidad"],$_POST["precio_venta"]);
			echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la factura";
		}
		else {
		}
	break;

	case 'anular':
		$rspta=$factura->anular($id_factura);
 		echo $rspta ? "Venta anulada" : "Venta no se puede anular";
	break;
	
	case 'eliminar':
		$rspta=$factura->eliminar($id_factura);
		echo $rspta ? "Factura eliminada" : "Factura no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$factura->mostrar($id_factura);
 		echo json_encode($rspta);
	break;
	
	case 'listarDetalle':
		$id = $_GET['id'];
		$rspta = $factura->listarDetalle($id);
		echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Codigo</th>
                                    <th>Artículo</th>
                                    <th>U. Medida</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub total</th>
                                    <th>IGV</th>
                                    <th>Importe</th>
                                </thead>';
        while($reg = $rspta->fetch_object()){
        	echo '<tr class="filas">
        			<td></td><td>'.$reg->codigo_prod.'</td>
        			<td>'.$reg->descripcion_prod.'</td>
        			<td>'.$reg->unidad_medida.'</td>
        			<td>'.$reg->precio_venta.'</td>
        			<td>'.$reg->cantidad.'</td>
        			<td>'.round($reg->subtotal,2).'</td>
        			<td>'.round($reg->igvt,2).'</td>
        			<td>'.round($reg->importe,2).'</td>
        			</tr>';
        			$op_gravadas = $reg->op_gravadas;
        			$igv_total = $reg->igv_total;
        			$total_venta = $reg->total_venta;

        }
        echo '  <tfoot>
                                  <tr>
                                    <th colspan="6"></th>
                                    <th colspan="2">SUBTOTAL</th>
                                    <th><h4 id="totalg">'.$op_gravadas.'</h4><input type="hidden" name="op_gravadas" id="op_gravadas"></th>
                                  </tr>
                                  
                                   <tr>
                                    <th style="height:2px;"  colspan="6"></th>
                                    <th colspan="2">IGV</th>
                                    <th><h4 id="totaligv">'.$igv_total.'</h4><input type="hidden" name="igv_total" id="igv_total"></th>
                                   </tr>
                                   <tr>
                                    <th style="height:2px;" colspan="6"></th>
                                    <th style="height:2px;" colspan="2">TOTAL</th>
                                    <th style="height:2px;"><h4 id="totalventa">'.$total_venta.'</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                                   </tr>
                                </tfoot>';

	break;
	
	case 'listar':
		$rspta=$factura->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$url_ticket = '../reportes/facturacion-tiket.php?id=';
			$url_pdf = '../reportes/facturacion.php?id=';
 			$data[]=array(
 				"0"=>
				// (($reg->estado=='Aceptado')? 
 				 					// '<button class="btn btn-danger" onclick="anular('.$reg->id_factura.')"><i class="fa fa-close"></i></button>':
									// '<button class="btn btn-danger" onclick="eliminar('.$reg->id_factura.')"><i class="fa fa-trash"></i></button>').
 				// '<a target="_blank" href="'.$url.$reg->id_factura.'"> <button class="btn btn-info"><i class="fa fa-file"></i></button></a>',

				'<a target="_blank" href="'.$url_ticket.$reg->id_factura.'"> <button class="btn btn-info"><i class="fa-file-text-o"></i></button></a>'.
 				'<a target="_blank" href="'.$url_pdf.$reg->id_factura.'"> <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i></button></a>',

 				"1"=>$reg->fecha,
 				"2"=>$reg->cliente,
 				"3"=>$reg->usuario,
 				"4"=>$reg->tipo_comprobante,
 				"5"=>$reg->serie.'-'.$reg->correlativo,
 				"6"=>number_format($reg->total_venta,2,'.',','),
 				"7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'

				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectCliente':
		require_once "../modelos/Persona.php";
		$persona = new Persona();

		$rspta = $persona->listarC();

		while ($reg = $rspta->fetch_object())
				{
				echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
				}
	break;


	
	case 'mostrarDatoCliente':
		require_once "../modelos/Persona.php";
		$persona = new Persona();
		$rspta = $persona->mostrar($idcliente);
		echo json_encode($rspta);
	break;

	case 'maximaVenta':
		$rspta = $factura->maxVenta($tipo_comprobante);
		echo json_encode($rspta);
	break;

	case 'selectTipoPago':
		$rspta = $factura->selectTipoPago();// -- 
		//echo '<option value="all">Todos</option>';
		while ($reg = $rspta->fetch_object()) {
			echo '<option value='.$reg->codigotipo_pago.'>'.$reg->descripcion_tipo_pago.'</option>';
		}
		break;
	case 'selectTipoComprobante':
		$rspta = $factura->selectTipoComprobante();
		while ($reg = $rspta->fetch_object()) {
			echo '<option value='.$reg->codigotipo_comprobante.'>'.$reg->descripcion_tipo_comprobante.'</option>';
		}
	break;

	case 'selecTipoIGV':
		$rspta=$factura->selecTipoIGV();
		while($reg=$rspta->fetch_object()){
			echo '<option value='.$reg->porcentaje.'>'.$reg->porcentaje.'</option>';
		}
		break;
}
?>
