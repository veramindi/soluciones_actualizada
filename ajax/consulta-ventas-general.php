<?php
    require_once "../modelos/consulta-ventas-general.php";

    $ConsultaVentaxSerie = new ConsultaVentaxSerie();

  
    
    switch($_REQUEST["operacion"]){
        case "consultaxSerieVendida":
            $fecha_inicio=$_REQUEST["fecha_inicio"];
            $fecha_fin=$_REQUEST["fecha_fin"];
            $producto=$_REQUEST["producto"];
            $serie=$_REQUEST["serie"];

            $rspta = $ConsultaVentaxSerie->getVentasxSerie($fecha_inicio,$fecha_fin,$producto,$serie);

            $data= Array();

            while($reg = $rspta->fetch_object()){
                list($anno,$mes,$dia) = explode("-", $reg->fecha);

                $data[]= [
                    "0"=>$dia."-".$mes."-".$anno,
                    "1"=>$reg->cliente,
                    "2"=>$reg->usuario,
                    "3"=>$reg->serie.'-'.$reg->correlativo,
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