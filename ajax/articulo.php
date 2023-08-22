<?php
require_once "../modelos/Articulo.php";

$articulo=new Articulo();

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$unidadmedida=isset($_POST["unidadmedida"])? limpiarCadena($_POST["unidadmedida"]):"";
$descripcion_otros='';
$astock=isset($_POST["astock"])? limpiarCadena($_POST["astock"]):"";
$afectacion=isset($_POST["afectacion"])? limpiarCadena($_POST["afectacion"]):"";
if($unidadmedida=='otros'){
	
	$descripcion_otros=isset($_POST["detalleunidad"])? limpiarCadena($_POST["detalleunidad"]):"";
}



switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}
		if (empty($idarticulo)){
			$rspta=$articulo->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen,$unidadmedida,$descripcion_otros,$afectacion);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen,$unidadmedida,$descripcion_otros,$afectacion);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$articulo->desactivar($idarticulo);
 		echo $rspta ? "Artículo Desactivado" : "Artículo no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$articulo->activar($idarticulo);
 		echo $rspta ? "Artículo activado" : "Artículo no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$articulo->mostrar($idarticulo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	// break;
 	case 'mostrarCodigoBarra':
 		$rspta=$articulo->imprimirCodigoBarra($idarticulo);
 		echo json_encode($rspta);
 		break;

 	case 'mostrarStock':
 		$rspta=$articulo->mostrarStock($idarticulo);
 		echo json_encode($rspta);
 		break;

 	case 'agregarStockk':

 		$id=$_POST['idarti'];
		$stockanti=$_POST['stockanti'];
		$stocknew=$_POST['stocknew'];

 		$rspta=$articulo->agregarstock($id,$stockanti,$stocknew);
 		// echo json_encode($rspta);
 		echo $rspta ? "Articulo agregado al stock" : "No se pudo agregar mas artículos al stock";
 		break;


	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			if($reg->unidad_medida=='otros' ){
 				$medida=$reg->descripcion_otros;
 			}else{ 
 				$medida=$reg->unidad_medida;
 				if($medida=="NIU"){
 					$medida="UND";
 				}
 			}
			
 			$data[]=array(

 				"0"=>($reg->condicion)?'<button class="btn btn-warning" id="editando" onclick="mostrar('.$reg->idarticulo.')" ><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>'. 
 					' <button class="btn btn-success" onclick="mostrarCodigoBarra('.$reg->idarticulo.')" data-toggle="modal" data-target="#modalcodigobarra" ><i class="fa fa-barcode"></i></button>'.
 					' <button class="btn btn" onclick="mostrarStock('.$reg->idarticulo.')" data-toggle="modal" data-target="#modalagregarstock" ><i class="fa fa-plus-circle"></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>'.
 					' <button class="btn btn-success" onclick="mostrarCodigoBarra('.$reg->idarticulo.')" data-toggle="modal" data-target="#modalcodigobarra" onclick=""><i class="fa fa-barcode"></i></button>',

 				"1"=>$reg->nombre,
 				"2"=>$reg->categoria,
 				"3"=>$reg->codigo,
 				"4"=>$reg->stock,
 				"5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
 				"6"=> $medida,
 				// "7"=>$medida,
 				"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../modelos/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . ' selected>' . $reg->nombre . '</option>';
				}
	break;


	case "listar_precios":
		$rspta = $articulo->listar_precios();
		$data = array();
		while ($reg = $rspta->fetch_object()) {
			if($reg->unidad_medida=='otros' ){
 				$medida=$reg->descripcion_otros;
 			}else{ 
 				$medida=$reg->unidad_medida;
 				if($medida=="NIU"){
 					$medida="UND";
 				}
 			}
 			$data[]=array(

 				"0"=>$reg->nombre,
 				"1"=>$reg->categoria,
 				"2"=>$reg->codigo,
 				"3"=>$reg->stock,
 				"4"=>$reg->precio_compra,
 				"5"=>$reg->precio_venta,
 				"6"=> $medida,
 				// "7"=>$medida,
 				"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				
 				);
		}
		$results = array(
			"sEcho"=>1,
			"iTotalRecords"=>count($data),
			"iTotalDisplayRecords"=>count($data),
			"aaData"=>$data
		);
		echo json_encode($results);
	break;
	case 'resetearstock':
		$rspta=$articulo->resetearstock($idarticulo);
	  break;
}
?>
