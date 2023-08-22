<?php
//Activar el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombre"]))
{
  header("Location:index.php"); 
}
else {

  require 'header.php';
  if($_SESSION['servicio']==1)
  {
   ?>
  <style type="text/css">
    .servicio{
      height: 100px;
      


    }
  </style>
   <!--Contenido-->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">

     <!-- Main content -->
     <section class="content">
       <div class="row">
         <div class="col-md-12">
           <div class="box">
             <div class="box-header with-border">
               <h1 class="box-title">Registro de Servicios de Soporte&nbsp;&nbsp;&nbsp;&nbsp;<button id="agregarservicio" class="btn btn-success"
                 onclick="mostrarform(true)">
                 <i class="fa fa-plus-circle"></i> &nbsp;&nbsp;Nuevo Registro</button></h1>

                 <div class="box-tools pull-right">
                 </div>
               </div>
               <!-- /.box-header -->
               <!-- centro -->
               <div class="panel-body table-responsive"  id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <th>Opciones</th>
                   <th>Fecha Ingreso</th>
                    <th style="width: 20%">Nombre Cliente</th>
                    <th>Tipo del Equipo</th>
                    <th>Estado Servicio</th>
                    <th>Estado Entrega</th>
                    <th>Estado Pago</th> 
                    <th>Tecnico Respon.</th>                  
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Fecha Ingreso</th>
                    <th style="width: 20%">Nombre Clientes</th>
                    <th>Tipo del Equipo</th>
                    <th>Estado Servicio</th>
                    <th>Estado Entrega</th>
                    <th>Estado pago</th>
                    <th>Tecnico Respon.</th>
                     
                  </tfoot>
                </table>
              </div>

              <div class="panel-body" style="height:990px;" id="formularioregistros">
                <!--Formulario-->
                <form name="formulario" method="POST" id="formulario"> 
                  <div class="col-lg-12">
                    <label>Codigo de Servicio</label><br>  
                    <div  class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">
                      <input type="numer" class="form-control" name="codigo_soporte" id="codigo_soporte" maxlength="50">
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Fecha de Ingreso: &nbsp; </label>
                      <input type="date" id="fecha_ingreso" name="fecha_ingreso">
                      
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <label>Fecha de Entrega: &nbsp; </label>
                      <input type="date" id="fecha_salida" name="fecha_salida">
                    </div>
                  </div> 
<!--                   
                  <div class="col-lg-12"> 
                    <label>Datos del Cliente</label>  <br>     
                                
                    <div  class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">                                 
                      <select id="sltransportista" name="sltransportista" class="form-control selectpicker" data-live-search="true" required  data-style="btn-default" title="Razón social">
                    </div>
                    <br><br>
                  
                  <br><br><br>
                  
                
                    <div class="form-group col-lg-5 col-md-2 col-sm-2 col-xs-12"> 
                      <label>Telefono:</label><br>
                      <input type="numer" class="form-control" name="telefono" id="telefono" maxlength="50">
                    </div>
                    <div class="form-group col-lg-5 col-md-2 col-sm-2 col-xs-12"> 
                      <label>Direccion:</label>
                      <input type="numer" class="form-control" name="direccion" id="direccion" maxlength="50">
                    </div>
                    </div>              -->
                    &nbsp;&nbsp;&nbsp;&nbsp;<label>Datos del Cliente</label>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
                    &nbsp;&nbsp;&nbsp;&nbsp;<label>Cliente:</label>
                    <span id="nombre_cliente_span"></span>
                  <br>
                  <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12" id="select">                        
              <input type="hidden" name="idsoporte" id="idsoporte" value="">
              <input type="hidden" name="idsoportepago" id="idsoportepago" value="">
              <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required data-style="btn-default" title="Razón social" hidden>
              </select>
            </div>
                  <div class="form-group col-lg-3 col-md-2 col-sm-2 col-xs-12"> 
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                  </div>
                  <div class="form-group col-lg-3 col-md-2 col-sm-2 col-xs-12 "> 
                    <label>Dirección:</label>
                    <input type="text" class="form-control" name="direccioncliente" id="direccioncliente">
                  </div>
                </div>

                  <div class="col-lg-12"> 
                    <label>Datos del Equipo</label>  <br>                   
                    <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">                                 
                      <p>Tipo:  <input type="text" class="form-control" name="tipo_equipo" id="tipo_equipo" maxlength="50"></p>
                    </div>
                    <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
                      <p>Marca y Modelo: <input type="text" class="form-control" name="marca" id="marca" maxlength="50"></p>
                    </div><div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
                      <p>Accesorio: <textarea type="text" class="form-control servicio" name="accesorio" id="accesorio" cols="40" rows="3" style="resize: none;"></textarea></p>
                    </div>
                    
                  </div>
                  <div class="col-lg-12 "> 
                    <label>Diagnostico del Equipo</label>  <br>                   
                    <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">                                 
                      <p>Problema:  <textarea type="text" class="form-control servicio" name="problema" id="problema" cols="40" rows="4" style="resize: none;"></textarea></p>
                    </div>
                    <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
                      <p>Solucion: <textarea type="text" class="form-control servicio" name="solucion" id="solucion" cols="40" rows="4" style="resize: none;"></textarea></p>
                    </div>
                    <div  class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12"> 
                      <p>Recomendacion Tecnica: <textarea type="text" class="form-control servicio" name="recomendacion" id="recomendacion" cols="40" rows="4" style="resize: none;"></textarea></p>
                    </div>
                    
                  </div>
                  <div class="col-lg-12">
                    <label>Estado</label><br> 
                    <div  class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 ">   
                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">                  
                        Servicio
                        <select class="form-control select-picker" name="estado_servicio" id="estado_servicio" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Reparacion">Reparacion</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                      </div> 
                      
                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        Entrega
                        <select class="form-control select-picker" name="estado_entrega" id="estado_entrega" required>
                         <option value="Pendiente">Pendiente</option>
                         <option value="Entregado">Entregado</option>                                            
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">                
                        Pago
                        <select class="form-control select-picker" name="estado_pago" id="estado_pago" required>
                         <option value="Pendiente">Pendiente</option>
                         <option value="Pagado">Pagado</option>
                         <option value="Sin Servicio">Sin Servicio</option>
                         <option value="Por Servicio">Por Servicio</option>  
                        </select>
                      </div> 
                    </div> 
                  
                    <div class="modal-body" id="cuotasdepago" >
                      <div class="col-lg-6">
                        <table id="tblpagos">
                          <!-- Cabecera 4 datos -->
                          <tr>
                            <th>Fecha de pago</th>
                            <th>Monto pagado</th>
                            <th>Saldo Restante</th>
                            <th>Tipo de pago &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                          </tr>
                        </table>
                    </div>
                  </div>
                  <!-- inicio -->
                  <div class="col-lg-12  form-inline">
                    <div class="form-group col-lg-3 col-md-2 col-sm-2 col-xs-12 ">
                    <label>Costo del Servicio</label> <br>
                    <p>Total: S/  <input type="numer" class="form-control" name="total" id="total" maxlength="50" ></p>
                  <br>
                  </div>

                 <!-- <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <p>A Cuenta S/ <input type="numer" class="form-control" name="cuota" id="cuota" maxlength="50"></p>
                      </div> -->
                      <!-- <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                      <p>Saldo S/ <input type="numer" class="form-control" name="saldo" id="saldo" maxlength="50" readonly></p>
                      </div> -->
                  <div class="form-group col-lg-4 col-md-2 col-sm-2 col-xs-12"  id="selectrdf"> 
                    <label>Tecnico:</label>
                    <select id="idtecnico" name="idtecnico" class="form-control selectpicker" data-live-search="true" required  data-style="btn-default" title="Tecnico">
                            </select>
                  </div>
                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 "> 
                    <label>Garantia del Servicio:</label>
                    <input type="text" class="form-control" name="garantia" id="garantia" placeholder="Nombre">
                  </div>
                </div>
                <style>
  /* Form styling */
  
  .box {
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    background-color: #fff;
    overflow: auto;
  }

  .box-header {
    background-color: teal;
    color: white;
    border-bottom: 1px solid #ddd;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-weight: bold;
    color: black;
  }

  .form-control {
    background-color: #f9f9f9;
    border: 1px solid black;
    border-radius: 4px;
    color: #555;
    height: 34px;
    padding: 6px 12px;
    transition: border-color 0.3s ease;
    width: 100%;
  }

  .form-control:focus {
    border-color: #6c757d;
    outline: none;
  }


  /* Radio button styling */
  .radio-label {
    display: inline-block;
    margin-right: 10px;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
  }

  .radio-label input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }

  .radio-label span {
    position: absolute;
    top: 2px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 50%;
  }

  .radio-label span:before {
    content: "";
    position: absolute;
    display: none;
  }

  .radio-label input:checked ~ span {
    background-color: #28a745;
    border-color: #28a745;
  }

  .radio-label input:checked ~ span:before {
    display: block;
  }

  .radio-label span:before {
    top: 5px;
    left: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #fff;
  }

  /* Select styling */
  select {
    background: blue;
    border: 1px solid #99ccff;
    color: #333;
    height: 34px;
    padding: 6px 12px;
  }
</style>


<div class="col-lg-12 form-inline">
  <!-- Form elements here -->
</div>

                
                  <!-- No olvidarse del ID : Atte: ANONYMOUS(EL PERRO) -->
                  <!-- <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="idsoporte" id="idsoporte" value="idsoporte">
                  </div> -->
                 
                  <!-- fin -->
                    
                    <div id="ventanaEmergente" class="ventana-emergente">
                    <div class="contenido-ventana">
  <span class="cerrarVentana" onclick="cerrarVentanaEmergente()">X</span>
  <h3 class="titulo-ventana">Ingrese los datos del pago:</h3>
  <table>
    <tr>
      <th>Fecha de Pago</th>
      <th>Monto a pagar</th>
      <th>Saldo</th>
      <th>Tipo de pago</th>
    </tr>
    <tr>
      <td><input type="date" name="fecha_pago" id="fecha_pago"></td>
      <td><input type="number" name="cuotas" id="cuotas"></td>
      <td><input type="number" name="saldos" id="saldos"></td>
      <td><input type="text" name="tipo_pago" id="tipo_pago"></td>
    </tr>
  </table>
  <div class="boton-container">
    <button type="button" id="btnguardarpagos" onclick="guardarPagos()">Guardar</button>
  </div>
  <!-- <input type="hidden" name="idsoporte" value=""> -->
  <!-- <input type="hidden" name="idcliente" value=""> -->
  <input type="hidden" name="idsoportepago" value="">
</div>
</div>
<style>
  

                      table {
                        border-collapse: collapse;
                      }

                      table, th, td {
                      border: 1px solid black;
                      padding: 5px;
                      }
                      th {
    font-weight: bold;
    text-align: center;
  }

                      tr {
                      border: 1px solid black;
                      }

                      .ventana-emergente {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  z-index: 9999;
}


#btnguardarpagos {
  margin-top: 5px;
  margin-left:45%;
}
.cerrarVentana {
  position: absolute;
  top: 0;
  right: 0;
  margin-right: 13px;
  margin-top: 7px;
  cursor: pointer;
}

.contenido-ventana {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  border: 3px solid #19A7CE;
  display: flex;
  flex-direction: column;
}

.titulo-ventana {
  color: #fff;
  background-color: #19A7CE;
  padding: 10px;
  margin-bottom: 20px;
}

@keyframes pulsate {
  0% {
    box-shadow: 0 0 20px rgba(255, 0, 100, 0.5);
  }
  50% {
    box-shadow: 0 0 40px rgba(255, 0, 50, 0.9);
  }
  100% {
    box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
  }

}
                    </style>
                 

           
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <br>
            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>&nbsp;&nbsp; Guardar</button>
            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> &nbsp;&nbsp;Cancelar</button>
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
else {
 require 'noacceso.php';
}
require 'footer.php';

?>

<script type="text/javascript" src="scripts/servicios-soporte.js">
</script>
<?php
}
ob_end_flush();

?>
