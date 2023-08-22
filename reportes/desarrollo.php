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

	try {
	    ob_start();
	        
		include dirname(__FILE__).'/reporteDesarrollo.php';
	    $content = ob_get_clean();

	    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8');
	    $html2pdf->pdf->SetDisplayMode('fullpage');
	    $html2pdf->writeHTML($content);
	    $html2pdf->output('desarrollo.pdf');
		$conexion->close(); 	  

	} catch (Html2PdfException $e) {
	    $html2pdf->clean();

	    $formatter = new ExceptionFormatter($e);
	    echo $formatter->getHtmlMessage();
	}

}
ob_end_flush();
?>
