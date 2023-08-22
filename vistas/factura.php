<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
require 'header.php';

if ($_SESSION['ventas']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <!-- <link rel="stylesheet" type="text/css" href="css/venta_radio.css"> -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Factura por Servicio &nbsp;&nbsp;<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Agregar</button></h1>
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
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                        <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                          <label><i class="fa fa-address"></i>Cliente(*):</label>
                          <input type="hidden" name="id_factura" id="id_factura">
                          <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required title="Seleccionar nombre del cliente" data-style="btn-default">
                          </select>
                        </div>

                          <!-- <div class="form-group col-lg-8 col-md-7 col-sm-7 col-xs-12">
                      <label><i class="fa fa-address"></i> Cliente(*):</label>
                      <input type="hidden" name="id_factura" id="id_factura">
                      <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required title="Seleccionar nombre del cliente" data-style="btn-default">
                      </select>
                    </div> -->

                      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label>Fecha Emision:</label>
                        <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="">
                        <script type="text/javascript" src="scripts/calendario.js"></script>
                      </div>

                      <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label>Moneda:</label>
                        <input type="text" class="form-control " name="moneda" id="moneda" placeholder="S/." value="Nuevo Sol" readonly>
                    </div>

                    <div class="form-group col-lg-1 col-md-2 col-sm-2 col-xs-12">
                      <label>Impuesto:</label>
                      <select name="impuesto" id="impuesto" class="form-control selectpicker" disabled required></select>
                      <!-- <input type="text" name="impuesto" id="impuesto" class="form-control" value="<?php echo $igv; ?>" required> -->
                      <input type="hidden" name="igv_asig" id="igv_asig">
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Nº de documento:</label>
                      <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Numero de documento" readonly>
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label>Dirección:</label>
                      <input type="text" class="form-control" name="direccioncliente" id="direccioncliente" placeholder="Dirección" readonly>
                    </div> 

                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Tipo Pago(*):</label>
                      <select name="codigotipo_pago" id="codigotipo_pago" class="form-control selectpicker" required="" data-live-search="true"></select>
                    </div>





                    <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label><i class="fa fa-user"></i> Tipo de documento:</label>
                      <input type="text" class="form-control" name="tipo_documento" id="tipo_documento" placeholder="Tipo de documento" readonly>
                    </div> -->

                    <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label><i class="fa fa-pencil"></i> Numero de documento:</label>
                      <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Numero de documento" readonly>
                    </div> -->

                    <!-- <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <label><i class="fa fa-home"></i> Dirección:</label>
                      <input type="text" class="form-control" name="direccioncliente" id="direccioncliente" placeholder="Dirección" readonly>
                    </div> -->


                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Tipo Comprobante(*):</label>
                      <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="" data-live-search="true"></select>
                    </div>

                    <!-- <label ><i class="fa fa-address"></i>ㅤTipo Comprobante(*):</label> -->
                    <!-- <div id="tipocompro"> -->
                    <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" id="ff"> -->
                        <!-- <input type="radio" id="factn" value="Factura" name="tipo_comprobante""> -->
                        <!-- <input type="radio" id="factn" value="Factura" name="tipo_comprobante" checked="checked"> -->
                        <!-- <label for="factn"> Factura</label> -->
                      <!-- </div> -->
                      <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 "> -->
                        <!-- <input type="radio" value="Boleta" id="facts" name="tipo_comprobante" id="boleta"> -->
                        <!-- <label for="facts"> Boleta</label> -->
                      <!-- </div> -->
                      
                    <!-- </div> -->


                    <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label><i class="fa fa-barcode"></i> Serie:</label>
                      <input type="text" class="form-control" name="serie" id="serie" maxlength="4" placeholder="Serie" readonly>
                    </div> -->

                    <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label><i class="fa fa-file"></i> Correlativo:</label>
                      <input type="text" class="form-control" name="correlativo" id="correlativo" maxlength="8" placeholder="Número" readonly>
                    </div> -->
<!--                     
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label><i class="fa fa-calendar"></i> Fecha(*):</label>
                      <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required readonly>
                    </div> -->

                    <!-- <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label><i class="fa fa-money"></i> Moneda:</label>
                      <input type="text" class="form-control " name="moneda" id="moneda" placeholder="S/." value="Nuevo Sol" readonly>
                      <input type="hidden" class="form-control" name="impuesto" id="impuesto">
                    </div> -->

                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha Vencimiento(*):</label>
                      <input type="date" class="form-control" name="fecha_ven" id="fecha_ven" required="">
                    </div>










                  <!--   <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tipo Comprobante(*):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="" data-placeholder="Selecciona Tu Moneda" data-style="btn-warning">
                              <option value="RUC">RUC</option>
                              <option value="DNI">DNI</option>
                            </select>
                          </div> -->
 
                          <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <a data-toggle="modal" href="#myModal">
                      <button id="btnAgregarArt" type="button" class="btn btn-primary" onclick="agregarDetalle()"> <span class="fa fa-plus"></span>&nbsp;&nbsp;Agregar Servicio</button>
                    </a>
                  </div>
                         
                          
                           
                          

                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive ">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th style="width:90px;">Codigo</th>
                                    <th>Servicio</th>
                                    <th>U. Medida</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub total</th>
                                    <th>IGV</th>
                                    <th>Importe</th>
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
                                    <th colspan="6"></th>
                                    <th colspan="2">SUBTOTAL</th>
                                    <th><h4 id="totalg">0.00</h4><input type="hidden" name="op_gravadas" id="op_gravadas"></th>
                                  </tr>
                                  
                                   <tr>
                                    <th style="height:2px;"  colspan="6"></th>
                                    <th colspan="2">IGV</th>
                                    <th><h4 id="totaligv">0.00</h4><input type="hidden" name="igv_total" id="igv_total"></th>
                                   </tr>
                                   <tr>
                                    <th style="height:2px;" colspan="6"></th>
                                    <th style="height:2px;" colspan="2">TOTAL</th>
                                    <th style="height:2px;"><h4 id="totalventa">0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                                   </tr>
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

<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/factura.js"></script>
<?php
}
ob_end_flush();
?>
  
