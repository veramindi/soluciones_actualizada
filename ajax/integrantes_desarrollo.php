<?php

require_once "../modelos/Integrantes_desarrollo.php";

$integrante = new Integrantes();

$idintegrant_desarrollo=isset($_POST["idintegrant_desarrollo"])? limpiarCadena($_POST["idintegrant_desarrollo"]):"";
$nombre_integrantes=isset($_POST["nombre_integrantes"])? limpiarCadena($_POST["nombre_integrantes"]):"";
switch ($_GET["op"]) {
    case 'guardar':
        if(empty($idintegrant_desarrollo)){
            $rspta=$integrante->insertar($nombre_integrantes);
            echo $rspta ? "Integrante registrado" : "No se puedieron registrar todos los datos del Integrante";
        }else{
            $rspta=$integrante->editar($idintegrant_desarrollo,$nombre_integrantes);
        }
        break;
    
        case 'mostrar':
            $rspta=$integrante->mostrar($idintegrant_desarrollo);
            //codificar el resultado usando json
            echo json_encode($rspta);
          break;

    case 'listarIntegrantes':
        $rspta=$integrante->listarIntegrante();

        //Declaramos un array
        $data=Array();

        while ($reg=$rspta->fetch_object()) {
            $data[] = array(
                "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idintegrant_desarrollo.')"><i class="fa fa-pencil"></i></button>'.
          ' <button class="btn btn-danger" onclick="eliminar('.$reg->idintegrant_desarrollo.')"><i class="fa fa-trash"></i></button>',
          "1"=>$reg->nombre_integrantes
            );
        }
        $results= array(
            "sEcho"=>1, //Informacion para el datatable
            "iTotalRecords"=>count($data),//Enviamos el total de registtros en el datatable
            "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
            "aaData"=>$data);
          echo json_encode($results);

        break;

        case 'eliminar':
            $rspta=$integrante->eliminar($idintegrant_desarrollo);
            echo $rspta ? "Integrante eliminado" : "Integrante no se pudo eliminar";
          break;
}

?>