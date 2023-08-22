<?php
if(strlen(session_id()) < 1)
  session_start();
  date_default_timezone_set('America/Lima'); 
// En windows
setlocale(LC_TIME, 'spanish');
 ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Formulario Contacto</title>
		<style type="text/css">
			table {color:black; 
				border: none;
				width: 100%;}
				.header{
					/*display: inline-block;*/
					padding-left: 20px; 
					padding-right: 20px; 
				}
				.text{
					padding-left: 40px; 
					padding-right: 40px;
					padding-top: -10px;
					padding-bottom: -10px;
					text-align:justify-all;
					line-height: 150%;
					border: solid 0.3px #000;
				}
				.text1{
					padding-left: 400px; 
					margin-left: 40px;
					margin-top: 8px;
					padding-right: 40px;				
					text-align:justify-all;
					line-height: 200%;
				}
				.text2{
					padding-left: 50px; 
					padding-right: 40px;
					padding-bottom:  10px;
					text-align:justify-all;
					line-height: 170%;
				}
				.info{
					width: 100%; 					
					font-size:14px;
					text-align:justify;
				}
				.factura{
					color: red;
					width: 28%;
					height:10px;
					border: 1px solid red;
					text-align: center;
				}
				.linea{
					padding-left: 20px; 
					padding-right: 20px;

				}
				.cliente{
					padding-left: 40px; 
					padding-right: 60px;
					width: 96%;
					font-size: 11px;
					
				}
				.articulos{
					padding-left: 40px; 
					padding-right: 40px;
					font-size:13px;
				}
				.cabecera{
					background:#087DA2;
					color:white;
					font-size:12px;
					padding-left: 20px; 
					padding-right: 20px;
				}
				.foot{
					padding-left: 20px; 
					padding-right: 20px;
					font-size: 8pt;
				}
				.productos{
					font-size:12px;
					border-collapse: collapse;
					padding-left: 20px; 
					padding-right: 20px;
					margin-left: 15px;	 	
				}
				.aviso{		 	
			 	font-size: 10pt;	
			 	margin-left: 10px;
			 	margin-right: 10px;
			 	text-align: justify;
			 	padding: 20px;
			 	padding-top: 10px;
			 	padding-bottom: 10px;
			 	border: solid 0.3px #000;

				 }	
				.serie{		 	
			 	font-size: 16px;	
			 	margin-left: 40px;
			 	margin-right: 30px;
			 	text-align: center;	
			 	border: solid 0.3px #000;
			 	
			 	color: #FFFFFF;

			 	}					 
					.silver{
					background:white;
					padding: 3px 4px 3px;
				}
				.clouds{
					background:#ecf0f1;
					padding: 3px 4px 3px;
				}
				/*#encabezado {padding:10px 0; border-top: 1px solid; border-bottom: 1px solid; width:100%;}*/
				#encabezado .fila #col_1 {width: 15%}
				#encabezado .fila #col_2 {text-align:center; width: 55%}
				#encabezado .fila #col_3 {width: 15%}
				#encabezado .fila #col_4 {width: 15%}

				#encabezado .fila td img {width:50%}
				#encabezado .fila #col_2 #span1{font-size: 15px;}
				#encabezado .fila #col_2 #span2{font-size: 12px; color: #4d9;}
		</style>
	</head>
	<body>
		<?php 
			require_once "../modelos/Cotizacion.php";
			$cotizacion= new Cotizacion();
			$rsptac= $cotizacion->ventacabecera($_GET["id"]);
			$regc=$rsptac->fetch_object();
			$idcotizacion=$regc->idcotizacion;
			$cliente=$regc->cliente;
			$tipoDoc=$regc->tipo_documento;
			$numDoc=$regc->num_documento;
			$direccioncliente=$regc->direccion;
			$fecha=$regc->fecha;
			$referencia=$regc->referencia;
			$validez=$regc->validez;
			$igv_total=$regc->igv_total;
			$igv_asig=$regc->igv_asig;
			$total_venta=$regc->total_venta;	
			$rsptad= $cotizacion->ventadetalle($_GET["id"]);
			$item=0;
		?>
<!-- Footer Telefono -->	
	<!--<page_footer>
		<hr style="border: solid 0.3px red;">
	    <table style="width: 100%;">
	        <tr class="info">
	        	<td style="text-align: center; width: 40%">Telef.: (51)996 720 630 Email.:</td>  
	        	<td style="text-align: center; width: 40%">Email.: wilderjulca@solucionesintegralesjb.com </td>    
	        </tr>
	    </table>
    </page_footer>-->
<!-- Fin Footer Telefono -->	
<!-- Footer Imagen -->
	<!--<page_footer>
		<hr style="border: solid 0.3px red;">
	    <table style="width: 100%;">
	        <tr class="info">
	        	<td style=""><img style="width: 760px;height: 140px;" src="../files/perfil/footer.png"></td>
	        </tr>
	    </table>
    </page_footer>-->
<!-- Fin Footer Imagen -->
<!-- Footer Texto -->
 	<page_footer>   	
		<hr style="border: solid 0.3px red;">
		<table style="width: 100%" >
			<tr>
				<td style=" width: 100%; text-align: center;">
			          <span style=" font-style: italic; ">Antes de imprimir seleccione sólo lo necesario y <b>PIENSE EN EL MEDIO AMBIENTE</b>. </span><br>
			    </td>
			</tr>
		</table>
	</page_footer>
<!-- Fin Footer -->


<!-- Encabezado-->
		<page_header>
			<table id="encabezado">
				<tr class="fila">
					<td id="col_1" style="width: 96%" >
						<img style="width: 760px;height: 80px;" src="../files/perfil/cabecera.png">
					</td>
				</tr>
			</table>
			<table style="width: 95%" class="info">

		        <tr>
		        	<td style="width: 2%"></td> 
		        	<td style="width: 60%">Calle Luis Alberto De Las Casas 2° Piso - Chancay     	</td> 
		        	<td style="width: 40%">Email.: ventas@solucionesintegralesjb.com</td>
		        </tr>
		        <tr>
		        	<td style="width: 2%"></td> 
		        	<td style="width: 60%">Jr. Canchis N° 224 Independencia - Lima</td> 
		        	
		        	<td style="width: 18%">Cel.: 996 720 630</td>
		        </tr>		        
			</table>
		</page_header>	
		<br><br><br><br><br><br><br><br><br>
	<hr style=" border-color:#000">
<!-- Fin Encabezado-->	
<!-- Correlativo-->
		<div class="serie">
			<table style="width: 100%">
				<tr>					
					<td style=" width: 100%"><b>COTIZACION N° <?php $cadena = (string)$idcotizacion;
							for ($i=strlen($idcotizacion); $i <8 ; $i++) { 
								$cadena = '0'.$cadena;
							}
							echo $cadena;
							?> - SIJB - <?=date('Y')?></b>
					</td>
				</tr>
			</table>
		</div>	
<!-- Fin Correlativo-->			
<!-- Datos del cliente -->		
		<div class="cliente">
			<table style="width: 100%;">
				<tr>
					<td style="width: 13%;"><b>CLIENTE</b></td>
					<td style="width: 80%">: <?php echo strtoupper ( $cliente); ?></td>
				</tr>
				<tr>
					<td style="width: 13%;"><b>DIRECCIÓN</b></td>
					<td style="width: 80%;">: <?php echo strtoupper ( $direccioncliente); ?></td>
				</tr>
				<tr>
					<td style="width: 13%;"><b>REFERENCIA</b></td>
					<td style="width: 80%;">: <?php echo strtoupper ( $referencia); ?></td>
				</tr>	
			</table>
			<table style="width: 100%;">
				<tr>
					<td style="width: 13%"><b>FECHA</b></td>
					<td style="width: 26%">: <?php echo strftime("%d de %B del %Y", strtotime($fecha)); ?></td>
					<td style="width: 16%"><b>Validez de la Oferta</b></td>
					<td style="width: 10%">: <?php echo $regc->validez; ?> días</td>
					<td style="width: 15%"><b>Tipo Cotización</b> </td>
					<td style="width: 12%">: SERVICIO</td>
				</tr>
			</table>
			<table style="width: 100%;">
				<tr>
					<td style="width: 97%"><hr style="border: solid 0.3px #000;"></td>
					
					
				</tr>
			</table>
		</div>
<!-- Fin Datos del cliente -->	
		
	<!-- Presentenacion -->		
		<p class="text">
			Por la presente reciban un cordial saludo de nuestra empresa <b> SOLUCIONES INTEGRALES JB SAC,</b> con N° <b>RUC.10410697551</b>, así como nuestro agradecimiento, con la finalidad de ponernos a su disposición y ser una alternativa de solución a los requerimientos de su representada.
		</p>		
			<!-- Contenido -->
		<div  class="productos">
			<table   style="border: solid 0.3px #087DA2 ">
				<tr class="cabecera" style="width: 100%; text-align: center ">
					<th style="width: 5%;height: 15px; text-align:center">ITEM</th>
					<th style="width: 60%; text-align:center">DESCRIPCION</th>
					<th style="width: 5%; text-align:center">UND.</th>
					<th style="width: 11%; text-align: center;">PRECIO</th>
					<th style="width: 14%; text-align: center;">SUB TOTAL</th>
				</tr>
				<?php 
					while($regd=$rsptad->fetch_object()){
						$item+=1;
						if($item%2==0){
							$estilo='silver';
						}else{
							$estilo='clouds';
						}
				?>
				<tr style="text-align:center">
					<td class="<?php echo $estilo; ?>" style="width: 5%"><?php echo $item; ?></td>
					<td class="<?php echo $estilo; ?>" style="text-align:justify; width: 60%"><?php echo $regd->descripcion; ?></td>
					<td class="<?php echo $estilo; ?>" style="width: 5%"><?php echo $regd->cantidad; ?></td>
					<td class="<?php echo $estilo; ?>" style="text-align:right; width: 11%"><?php echo $regd->precio; ?></td>
					<td class="<?php echo $estilo; ?>" style="text-align:right; width: 14%"><?php echo $regd->subtotal; ?></td>
				</tr>
				<?php } ?>
			</table>
			<br><br>
			<table cellspacing="0" cellpadding="0" border="0.2"  align="center">
				<tr style="width: 100%; text-align: left; border:0.2">
					<b>
					<td style="text-align: center; width:20%">SUB, TOTAL</td>
					<td style="text-align: center; width:20%">IGV (<?php echo $igv_asig ?>%)</td>
					<td style="text-align: center; width:20%">IMPORTE TOTAL</td> </b>           
				</tr>
				<tr style="width: 100%; text-align: center;">
					<b>
					<td style="width:20%">S/&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format(($total_venta - $igv_total), 2, '.', ','); ?></td>
					<td style="width:20%">S/&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($igv_total,2,'.',','); ?></td>
					<td style="width:20%">S/&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format(( $total_venta) , 2, '.', ','); ?></td>	
					</b>				
				</tr>					
			</table>
			<br>
			<?php 
				require_once "numeroALetras.php";
				$letras = NumeroALetras::convertir($total_venta);
				list($num,$cen)=explode('.',$total_venta);
			?>
			<table>
				<tr style="width: 95%;">
					<td style=" width:90%; height: 14px;">SON:<b> <?php echo $letras.' Y '.$cen; ?>/100 SOLES</b></td><br>	
					<hr style="border-color:#000;">
				</tr>
			</table>
		</div>
		<br>
<!--  Medio de Pago-->
		<div class="aviso">
			<table style="width: 98%;">
				<tr>
					<td style="width: 95%;"><b>INSTRUCCIONES PARA PAGAR</b> </td>
				</tr>
				<tr>
					<td style="width: 98%;">
						Acercándose a una agencia u oficina del Banco, cajero automático, agente o transferencia por internet, (si el pago es de provincia considerar la comisión por plaza).  
					</td>				
				</tr>
			</table>
			<table style="width: 98%;">
				<tr>
					<td style="width: 28%;"><b>TITULAR DE LA CUENTA</b></td>
					<td style="width: 70%;">: WILDER FLORENTINO JULCA BRONCANO</td>					
				</tr>
			</table>
			<table style="width: 98%;">
				<tr>
					<td style="width: 28%;"><b>CUENTA SOLES BCP</b></td>
					<td style="width: 25%;">: 191-34789343-0-48</td>
					<td style="width: 4%;"><b>CCI</b></td>
					<td style="width: 30%;">: 00219113478934304852</td>
				</tr>
				<tr>
					<td style="width: 28%;"><b>CUENTA SOLES BBVA</b></td>
					<td style="width: 25%;">: 0011-0264-02-00083101</td>
					<td style="width: 4%;"><b>CCI</b></td>
					<td style="width: 30%;">: 011-264-000200083101-92</td>
				</tr>
				<tr>
					<td style="width:28%;"><b>CUENTA DETRACCIÓN BN</b></td>
					<td style="width: 25%;">: 00363002463</td>
					<td style="width: 4%;"><b></b></td>
					<td style="width: 30%;">: </td>
				</tr>		
			</table>
		</div>
		<!-- Fin Medio de Pago-->
	</body>
</html>