<?php
//Activar el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
    header("Location:index.php");
} else {



    require 'header.php';
    if ($_SESSION['almacen'] == 1) {
        ?>

        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border ">
                                <h1 class="box-title ">Artículo &nbsp; <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true);desactivarStock()"><i class="fa fa-plus-circle"></i> &nbsp; Agregar</button>
                                    <a target="_blank" href="../reportes/rptarticulos.php"> <button class="btn btn-info">Reporte</button> </a><a href="precio-articulos.php" class="btn btn-default">Precio de artículos</a>&nbsp;&nbsp;<button class="btn btn-primary" onclick="resetearstock('.$reg->idarticulo.')"><i class="fa fa-refresh"></i>&nbsp; Resetear Stock</button>

                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Código</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                    <th>Unidad Medida</th>
                                    <!-- <th>Unidad Medida</th> -->
                                    <th>Estado</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Código</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                    <th>Unidad Medida</th>
                                    <!-- <th>Unidad Medida</th> -->
                                    <th>Estado</th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST" autocomplete="off">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nombre(*):</label>
                                        <input type="hidden" name="idarticulo" id="idarticulo">
                                        <input type="text" class="form-control" name="nombre" id="nombre" onkeypress="especial(event)" maxlength="100" placeholder="Nombre" required>
                                        <script>
                                            function especial(e){
	                                            key=e.keyCode || e.which;
	                                            tecla= String.fromCharCode(key);
	                                            letraespecial="QWERTYUIOPASDFGHJKLZXCVBNMÑqw¨¨ertyuiopasdfghjklñzxcvbnm1234567890@#,;$_&-+(.)/*¿':;!?~`\•√π÷×¶∆£¢€¥^°={}%©®™✓[]";
	                                            especiales=[8,13,32,34];
	                                            tecla_especial=false;
                                                for(var i in especiales){
		                                            if (key==especiales[i]){
			                                        tecla_especial=true;
			                                        break;
		                                            } 
        
	                                                }
                                                    if(letraespecial.indexOf(tecla) != -1 || tecla_especial){
                                                    	// Se ingreso un caracter dentro de lo permitido
	                                                } else {
                                                    	// Se ingreso un caracter no permitido
                                                        e.preventDefault(); // Evita que se dispare el evento
                                                        alert('Este caracter no esta admitido');
                                                    }
                                                }                                               
                                                //Controla el pegado de texto en el input
                                                document.querySelector('#nombre').addEventListener('paste', (e) => {  letraespecial="QWERTYUIOPASDFGHJKLZXCVBNMÑqw¨¨ertyuiopasdfghjklñzxcvbnm1234567890@#,;$_&-+(.)/*¿':;!?~`\•√π÷×¶∆£¢€¥^°={}%©®™✓[] ";
    
                                                	const textPaste = (e.clipboardData || window.clipboardData).getData("text");
                                                    const arrayPaste = textPaste.split("");
                                                    let permitido = true;
                                                    arrayPaste.map(caracter => {
                                                    	if (letraespecial.indexOf(caracter) == -1){
                                                        	permitido = false;
                                                        }
                                                    });
                                                    if (!permitido) {
                                                    	e.preventDefault();
                                                    	alert("Este texto contiene caracteres no admitidos");
                                                    }
                                                })
                                        </script>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Categoría(*):</label>
                                        <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required></select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Unidad de medida(*):</label>
                                        <select id="unidadmedida" name="unidadmedida" class="form-control " required onclick="otros()">
                                            <option value="NIU">Unidades</option> <!-- 07 -->
                                            <option value="KGM">Kilogramos</option> <!-- 01 -->
                                            <option value="LBR">Libras</option> <!-- 02 -->
                                            <!-- <option value="LTN">Toneladas Largas</option> --><!-- 03-->
                                            <!-- <option value="TNE">Toneladas Métricas</option> --> <!-- 04 -->
                                            <!-- <option value="STN">Toneladas Cortas</option> --> <!-- 05 -->
                                            <option value="GRM">Gramos</option> <!-- 06 -->
                                            <option value="LTR">Litros</option> <!-- 08 -->
                                            <!-- <option value="GlI">Galones.</option> --> <!-- 09 -->
                                            <!-- <option value="BLL">Barriles</option> --> <!-- 10 -->
                                            <!-- <option value="CA">Latas</option> --> <!-- 11 -->
                                            <option value="BX">Cajas</option> <!-- 12 -->
                                            <!-- <option value="MLL">Millares</option> --> <!-- 13 --> 
                                            <option value="MTQ">Metros Cubicos</option> <!-- 14 -->
                                            <option value="MTR">Metros</option> <!-- 15 -->
                                            <option value="NIU">Otros</option> <!-- 99 -->
                                        </select>
                                    </div>
                                    <!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="detunidad">
                                      <label>Detalle...</label>
                                      <input type="text" class="form-control" name="detalleunidad" id="detalleunidad" placeholder="Especifique la unidad de medida">
                                    </div> -->
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="detaunidad">
                                        <label>Detalle de la unidad de medida...</label>
                                        <input type="text" class="form-control" name="detalleunidad" id="detalleunidad" placeholder="Especifique la unidad de medida">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Stock(*):</label>
                                        <input type="number" class="form-control" name="stock" id="stock" min="0" required readonly>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Descripción:</label>
                                        <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Imagen:</label>
                                        <input type="file" class="form-control" name="imagen" id="imagen">
                                        <input type="hidden" name="imagenactual" id="imagenactual">
                                        <img src="" width="150px" height="120px" id="imagenmuestra">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Código:</label>
                                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código Barras">
                                        <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
                                        <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                                        <div id="print">
                                            <svg id="barcode"></svg>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 afectacionArticulo">
                                        <input type="radio" name="afectacion" id="gravado" value="Gravado" checked="checked"> <label for="gravado">Gravado</label>
                                        <input type="radio" name="afectacion" id="exonerado" value="Exonerado"> <label for="exonerado"> Exonerado</label>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>&nbsp;  Guardar</button>

                                        <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>&nbsp;  Cancelar</button>
                                    </div>


                                </form>
                            </div>

                            <div class="modal fade" id="modalcodigobarra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #ECE7E7" >
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="exampleModalLabel">CODIGO DE BARRAS</h4>


                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                        </div>
                                        <div class="modal-body">
                                            <center><div class="row">

                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <input type="hidden" class="form-control" name="codigob" id="codigob" placeholder="Código Barras">
                                                        <div id="printb">
                                                            <svg id="barcodeb" 
                                                                 jsbarcode-format="upc" 
                                                                 jsbarcode-textmargin="0"
                                                                 jsbarcode-fontoptions="bold">
                                                            </svg>
                                                        </div>
                                                        <div id="mens"></div>
                                                        <!-- <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button> -->

                                                    </div>

                                                    <div class=" form-group col-lg-12 col-sm-12">
                                                        <button class="btn btn-success" onclick="imprimirb()"><i class="fa fa-print"></i> Imprimir</button>
                                                    </div>
                                                </div>
                                            </center>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" class="label bg-red"><i class="fa fa-times-circle"></i> Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalagregarstock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #ECE7E7" >
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="exampleModalLabel">AGREGAR STOCK</h4>


                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                        </div>
                                        <div class="modal-body">
                                            <center><div class="row">
                                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                        <input type="hidden" name="idarti" id="idarti">
                                                        <input type="hidden" name="stockanti" id="stockanti">

                                                        <input type="text" class="form-control" name="astock" id="astock" placeholder="Agregar stock">
                                                        <div class="msjRespuesta"></div>
                                                    </div>

                                                    <!--  <div class=" form-group col-lg-12 col-sm-12">
                                                       <button class="btn btn-success" data-dismiss="modal"><i class="fa fa-plus-circle"></i> Agregar</button>
                                                     </div> -->
                                                </div>
                                            </center>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" class="label bg-red"><i class="fa fa-times-circle"></i> Cerrar</button>

                                            <button class="btn btn-success" id="btnAgregarStock" onclick="" data-dismiss="modal"><i class="fa fa-plus-circle"></i> Agregar</button>

                                        </div>
                                    </div>
                                </div>
                            </div>







                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->
        <?php
    } else {
        require 'noacceso.php';
    }
    require 'footer.php';
    ?>
    <!-- <script type="text/javascript" src="script/articulo"></script> -->
    <script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
    <script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
    <script type="text/javascript" src="scripts/arti.js"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
          $('#btnAgregarStock').click(function{
            var idarti=$('#idarti').val();
            var stockanti=$('#stockanti').val();
            var stocknew=$('#astock').val();
            agregarStock(idarti,stockanti,stocknew);
          })
        })
    </script> -->
    <?php
}
ob_end_flush();
?>
