<?php
session_start();

require_once "../modelos/Usuario.php";
 
$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
		}

		//HASH SHA256
		$clavehash=hash("SHA256",$clave);

		if (empty($idusuario)){
			$rspta=$usuario->insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "No se puedieron registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		// break;
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
        "2"=>$reg->tipo_documento,
        "3"=>$reg->num_documento,
        "4"=>$reg->telefono,
        "5"=>$reg->email,
        "6"=>$reg->login,

 				"7"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
 				"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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

	case 'permisos':

	require_once "../modelos/Permiso.php";
	$permiso=new Permiso();
	$rspta=$permiso->listar();

	//Obtener los permisos asignados al usuarios
	$id=$_GET['id'];
	$marcados=$usuario->listarmarcados($id);
	//DEcalaramos el array para alamacenar todos los permisos marcados
	$valores=array();

	//Almacenar los permisos asignados al usuario en el Array
	while($per=$marcados->fetch_object())
	{
		array_push($valores,$per->idpermiso);
	}


	//MOstramos la lsita de permisos en la vista y si están o no marcados
	while($reg=$rspta->fetch_object())
	{
		$sw=in_array($reg->idpermiso,$valores)?'checked':'';
		echo '<li><input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
	}


	break;

	case 'verificar':
		case 'verificar':
			//////////////////////////////////////////////////////
				////Seguridad en login/servidor////
			/////////////////////////////////////////////////////
				//$conexion->set_sharset('utf8');
				////////////////////////////////
				//$logina=$_POST['logina'];
				//$clavea=$_POST['clavea'];
				///////////////////////////////////
				//$logina=real_escape_string($_POST['logina']) ? $_POST['logina'] : NULL;
				//$clavea=real_escape_string($_POST['clavea']) ? $_POST['clavea'] : NULL;
				$logina=$conexion->real_escape_string($_POST['logina']);
				$clavea=$conexion->real_escape_string($_POST['clavea']);
	
				//!empty($server['HTTP_X_REQUESTED_WITH']) && strtolower($server['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'
				$conexion=mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				$conectandoa="SELECT * FROM usuario where login='$logina' and clave='$clavehash'";
				$resu=mysqli_query($conexion,$conectandoa);
				$rspta=mysqli_num_rows($resu);
	
				//hash sha256 en la contraseña
				$clavehash=hash("SHA256",$clavea);
				$rspta=$usuario->verificar($logina,$clavehash);
				$fetch=$rspta->fetch_object();
	
				if(isset($fetch))
				{
				//declaramos las variables de session
				$_SESSION['idusuario']=$fetch->idusuario;
				$_SESSION['nombre']=$fetch->nombre;
				$_SESSION['imagen']=$fetch->imagen;
				$_SESSION['login']=$fetch->login;

				//obtenemos los permisos del usuarios

				$marcados=$usuario->listarmarcados($fetch->idusuario);
				//declaramos el array para almacenar todos los permisos $marcados
				$valores=array();

				//almacenamos los permisos marcados en el array
				while($per=$marcados->fetch_object())
				{
					array_push($valores,$per->idpermiso);

				}

                //determinamos los accesos del usuarios
                in_array(1,$valores) ? $_SESSION['escritorio']=1 : $_SESSION['escritorio']=0;
				in_array(2,$valores) ? $_SESSION['almacen']=1 : $_SESSION['almacen']=0;
				in_array(3,$valores) ? $_SESSION['compras']=1 : $_SESSION['compras']=0;
				in_array(4,$valores) ? $_SESSION['ventas']=1 : $_SESSION['ventas']=0;
				in_array(5,$valores) ? $_SESSION['servicio']=1 : $_SESSION['servicio']=0;
				in_array(6,$valores) ? $_SESSION['sucursal']=1 : $_SESSION['sucursal']=0;
				in_array(7,$valores) ? $_SESSION['consultac']=1 : $_SESSION['consultac']=0;
				in_array(8,$valores) ? $_SESSION['consultav']=1 : $_SESSION['consultav']=0;
				in_array(9,$valores) ? $_SESSION['consultal']=1 : $_SESSION['consultal']=0;
				in_array(10,$valores) ? $_SESSION['acceso']=1 : $_SESSION['acceso']=0;
				in_array(11,$valores) ? $_SESSION['administracion']=1 : $_SESSION['administracion']=0;
				in_array(12,$valores) ? $_SESSION['contabilidad']=1 : $_SESSION['contabilidad']=0;
				in_array(13,$valores) ? $_SESSION['configuracion']=1 : $_SESSION['configuracion']=0;
					
			}

			echo json_encode($fetch);

  break;

	case 'salir':
	//limpiamos las variables de session
	session_unset();
	//destruimos la sesion
	session_destroy();
	//redireccionamos al login
	header("Location: ../index.php");

	break;


}
?>
