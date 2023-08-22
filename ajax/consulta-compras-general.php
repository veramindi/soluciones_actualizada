<?php
    require_once "../modelos/Consulta-compras-general.php";

    $ConsultaCompraxSerie = new ConsultaCompraxSerie();

  
    
    switch($_REQUEST["operacion"]){
        case "consultaxSerieComprada":
            $fecha_inicio=$_REQUEST["fecha_inicio"];
            $fecha_fin=$_REQUEST["fecha_fin"];
            $producto=$_REQUEST["producto"];
            $serie=$_REQUEST["serie"];

            $rspta = $ConsultaCompraxSerie->getComprasxSerie($fecha_inicio,$fecha_fin,$producto,$serie);

            $data= Array();

            while($reg = $rspta->fetch_object()){
                list($anno,$mes,$dia) = explode("-", $reg->fecha);

                $data[]= [
                    "0"=>$dia."-".$mes."-".$anno,
                    "1"=>$reg->proveedor,
                    "2"=>$reg->usuario,
                    "3"=>$reg->serie_comprobante.'-'.$reg->num_comprobante,
                    "4"=>$reg->articulo,
                    "5"=>$reg->cantidad,
                    "6"=>$reg->serieArticulo,
                    "7"=>$reg->precio_venta

                ];

            }

            $result = [
                "sEcho" => 1,
                "iTotalRecords"=> count($data),
                "iTotalDisplayRecords"=> count($data),
                "aaData"=>$data
            ];
            echo json_encode($result);

        break;
    }


?>