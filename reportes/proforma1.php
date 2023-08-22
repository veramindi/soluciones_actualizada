<?php 
	// require_once __DIR__.'/vendor/autoload.php';

ob_start();  
require 'vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
	    // ob_start();
if ($_SESSION['ventas']==1)
{
	
	try {

 		ob_start();
		// require_once "../modelos/Perfil.php";
		// $perfil=new Perfil();
		// $rspta=$perfil->cabecera_perfil();
		// $reg=$rspta->fetch_object();
		// $ruc=$reg->ruc;


		require_once "../modelos/Proforma.php";
		$proforma = new Proforma();
		$rsptac= $proforma->ventacabecera($_GET["id"]);
		$regc=$rsptac->fetch_object();
		$idproforma=$regc->idproforma;
		$correlativo=$regc->correlativo;
		$detalle=$regc->detalle;
		$tipo_proforma=$regc->tipo_proforma;

		// require_once "../modelos/Proforma.php";
		// $proforma=new Proforma();
		// $rsptac= $proforma->ventacabecera($_GET["id"]);
		// $regc=$rsptac->fetch_object();

		// if($tipo_proforma=='productos'){
		if($detalle!="" || $detalle!=null){
			include dirname(__FILE__).'/proformaProductos.php';
		    $content = ob_get_clean();

		    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8');
		    $html2pdf->pdf->SetDisplayMode('fullpage');
		    $html2pdf->writeHTML($content);
		    $html2pdf->output('Proforma_'.$correlativo.'.pdf');
			$conexion->close(); 	  

		}else{
			include dirname(__FILE__).'/proformaServicios.php';
		    $content = ob_get_clean();

		    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8');
		    $html2pdf->pdf->SetDisplayMode('fullpage');
		    $html2pdf->writeHTML($content);
		    $html2pdf->output('Proforma_servicios_'.$idproforma.'.pdf');
			$conexion->close(); 

		}

				  

	

	} catch (Html2PdfException $e) {
	    $html2pdf->clean();

	    $formatter = new ExceptionFormatter($e);
	    echo $formatter->getHtmlMessage();
	}

}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>
<!-- <center>
 <form action="" method="POST">
 	<input type="text" name="v1" >
 	<input name="btn" type="submit" id="btn" value="Generar PDF">
 </form>
	
</center> -->