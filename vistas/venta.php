<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
//require_once "../ajax/venta2.php";

if (!isset($_SESSION["nombre"]))
{
  header("Location: index.php");
}
else
{
require 'header.php';

if ($_SESSION['ventas']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">
                            Ventas Por Boleta y Factura&nbsp;&nbsp;<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                              <i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Agregar</button></h1>
                              <a target="_blank" href="cliente.php"> <button class="btn btn-info">Clientes</button></a>                             
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Documento</th>
                            <th>Número</th>
                            <th>Total Venta</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Usuario</th>
                            <th>Documento</th>
                            <th>Número</th>
                            <th>Total Venta</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <label>Cliente(*):</label>
                            <input type="hidden" name="idventa" id="idventa">
                            <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required  data-style="btn-default" title="Seleccione cliente">
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Emision:</label>
                            <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" require>
                            <script type="text/javascript" src="scripts/calendario.js"></script>
                          </div>                       
                          <div class="form-group col-lg-2 col-md-3 col-sm-3 col-xs-12">
                            <label>Moneda:</label>
                            <!-- <input type="text" class="form-control " name="moneda" id="moneda" placeholder="S/." > -->
                            <select name="moneda" id="moneda" class="form-control selectpicker" required ></select>
                          </div>
                          <div class="form-group col-lg-1 col-md-2 col-sm-2 col-xs-12">
                            <label>Impuesto:</label>
                            <select name="impuesto" id="impuesto" class="form-control selectpicker" disabled required></select>
                            <!-- <input type="text" name="impuesto" id="impuesto" class="form-control" value="<?php echo $igv; ?>" required> -->
                            <input type="hidden" name="igv_asig" id="igv_asig">
                          </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Nº de documento:</label>
                            <input type="text" class="form-control" name="numdireccion" id="numdireccion" placeholder="Numero de documento">
                          </div>                          
                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Dirección:</label>
                            <input type="text" class="form-control" name="direccioncliente" id="direccioncliente" placeholder="Dirección">
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tipo Pago(*):</label>
                            <select name="codigotipo_pago" id="codigotipo_pago" class="form-control selectpicker" required="" data-live-search="true" onchange="detectaTipoPago(event)"></select>

                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Tipo Comprobante(*):</label>
                            <select name="codigotipo_comprobante" id="codigotipo_comprobante" class="form-control selectpicker" required="" data-live-search="true" onchange="detectaTipoPago(event)"></select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha Vencimiento(*):</label>
                            <input type="date" class="form-control" name="fecha_ven" id="fecha_ven" required="">
                          </div>

                          <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span>&nbsp;&nbsp;Agregar Artículos</button>
                            </a>
                          </div>
                      <!--     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Serie:</label>
                            <input type="text" class="form-control" name="serie" id="serie" maxlength="4" placeholder="Serie">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Correlativo:</label>
                            <input type="text" class="form-control" name="correlativo" id="correlativo" maxlength="8" placeholder="Número" >
                          </div> -->
                          
                           
                          

                          <div class="table-responsive col-lg-12 col-sm-12 col-md-12 col-xs-12" id="recargar">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Código</th>
                                    <th>Artículo</th>
                                    <th>Serie</th>
                                    <th>U. Medida</th>
                                    <th>Cantidad</th>
                                    <th>Venta U.</th>
                                   
                                    <th>Impuestos</th>
                                    <th>Precio Venta</th>
                                    <th>Venta Total </th>
                                    <th>&nbsp;&nbsp;Importe&nbsp;&nbsp;</th>
                                </thead>
                                <!-- <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                                </tfoot> -->
                                <tfoot>
                                  <tr>
                                    <th colspan="7"></th>
                                    <th style="text-align: right;"  colspan="2">TOTAL VENTA GRAVADO &nbsp;&nbsp;&nbsp;S/</th>
                                    <th style="text-align: right;"><h4 id="totalg">0.00</h4><input type="hidden" name="total_venta_gravado" id="total_venta_gravado"></th>
                                  <!-- </tr> -->
                                   <!-- <tr> -->
                                    <!-- <th colspan="8"></th> -->
                                    <!-- <th colspan="2">TOTAL VENTA EXONERADO</th> -->
                                    <!-- <th> -->
                                      <h4 id="totale"></h4><input type="hidden" name="total_venta_exonerado" id="total_venta_exonerado">
                                    <!-- </th> -->
                                   <!-- </tr> -->
                                   <!-- <tr> -->
                                    <!-- <th colspan="8"></th> -->
                                    <!-- <th colspan="2">TOTAL VENTA INAFECTAS</th> -->
                                    <!-- <th> -->
                                      <h4 id="totali"></h4><input type="hidden" name="total_venta_inafectas" id="total_venta_inafectas">
                                    <!-- </th> -->
                                   <!-- </tr> -->
                                   <!-- <tr> -->
                                    <!-- <th colspan="8"></th> -->
                                    <!-- <th colspan="2">TOTAL VENTA GRATUITAS</th> -->
                                    <!-- <th> -->
                                      <h4 id="totalgt"></h4><input type="hidden" name="total_venta_gratuitas" id="total_venta_gratuitas">
                                    <!-- </th> -->
                                   </tr>
                                   <tr>
                                    <!-- <th colspan="8"></th> -->
                                    <!-- <th colspan="2">TOTAL DESCUENTO</th> -->
                                    <!-- <th> -->
                                      <h4 id="totald"></h4><input type="hidden" name="total_descuentos" id="total_descuentos">
                                    <!-- </th> -->
                                   <!-- </tr> -->
                                   <!-- <tr> -->
                                    <!-- <th colspan="8"></th> -->
                                    <!-- <th colspan="2">ISC</th> -->
                                    <!-- <th> -->
                                      <h4 id="totalisc"></h4><input type="hidden" name="isc" id="isc">
                                    <!-- </th> -->
                                   </tr>
                                   <tr>
                                    <th style="height:2px;"  colspan="7"></th>
                                    <th style="text-align: right;" colspan="2">I.G.V.&nbsp;&nbsp;&nbsp;S/</th>
                                    <th style="text-align: right;"><h4 id="totaligv">0.00</h4><input type="hidden" name="total_igv" id="total_igv"></th>
                                   </tr>
                                  <tr>
                                    <th style="height:2px;" colspan="7"></th>
                                    <th style="height:2px; text-align: right;" colspan="2">TOTAL IMPORTE &nbsp;&nbsp;&nbsp;S/</th>
                                    <th style="height:2px; text-align: right;"><h4 id="totalimp">0.00</h4><input type="hidden" name="total_importe" id="total_importe"></th>
                                   </tr>
                                    <!-- <tr>
                                    <th style="height:2px;" colspan="7"></th>
                                    <th style="height:2px;" colspan="2">TIPO DE CAMBIO</th>
                                    <th style="height:2px;"><h4 id="tipo_cambio">0.00</h4><input type="hidden" name="tipo_cambio" id="tipo_cambio"></th>
                                   </tr>
                                   <tr>
                                    <th style="height:2px;" colspan="7"></th>
                                    <th style="height:2px;" colspan="2">TOTAL IMPORTE EN SOLES</th>
                                    <th style="height:2px;"><h4 id="total_soles">0.00</h4><input type="hidden" name="total_soles" id="total_soles"></th>
                                   </tr> -->
                                </tfoot>
                                    
                                <tbody>

                                </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>&nbsp;&nbsp; Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> &nbsp;&nbsp;Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header backColor">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Artículo</h4>
        </div>
        <div class="modal-body table-responsive">
          <table id="tblarticulos" class="table  table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>U. Medida</th>
                <th>Categoría</th>
                <th>Código</th>
                <th>Stock</th>
                <th>Precio Venta</th>
                <th>Imagen</th>
                <th>Afectacion</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>U. Medida</th>
                <th>Categoría</th>
                <th>Código</th>
                <th>Stock</th>
                <th>Precio Venta</th>
                <th>Imagen</th>
                <th>Afectacion</th>
            </tfoot>
          </table>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>

<script type="text/javascript" src="scripts/venta2.js"></script>
<?php
}
ob_end_flush();
?>
  
