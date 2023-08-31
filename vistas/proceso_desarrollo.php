<?php 
ob_start();
session_start();
  if (!isset($_SESSION['nombre'])) {
    header("Location:index.php");
  }else{
    require 'header.php';
  if($_SESSION['servicio']==1){
    if ($_GET['id'] == null) {
     <div class="content-wrapper">
    <!-- Content Header (Page header) -->


         <!-- Main content -->
         <section class="content">
             <div class="row">
               <div class="col-md-12">
                   <div class="box box-primary">
                   <div class="box-header with-border">
               <h1 class="box-title"> Proceso de Desarrollo</h1>
                 <div class="box-tools pull-right">
                 </div>
               </div>
                     <!-- /.box-header -->
                     <!-- centro -->
                     <div class="panel-body table-responsive"  id="listadoregistros">
                      <form  id="formulario" name="formulario" enctype="multipart/form-data">
                      <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12">
              <label class="linea_p">NOMBRE DEL CLIENTE:</label>
           <br>
              <input type="text" id="nombre_cliente" readonly value="<?php echo $reg->nombre; ?>">
              </div>
              <input type="hidden" name="idproc_desarrollo" id="idproc_desarrollo" value="<?php echo $reg->idproc_desarrollo; ?>">
          
                      <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12" >
              <label class="linea_p">NOMBRE DEL PROYECTO:</label><br>
              <!-- <spam id="nombre_proyecto"><?php echo $reg->nombre_proyecto; ?></spam> -->
              <input type="text" name="nombre_proyecto" id="nombre_proyecto" readonly value="<?php echo $reg->nombre_proyecto; ?>">

              </div>
           
                     
                            <div class="col-lg-12">
                            <label>ANÁLISIS</label><br>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha de Inicio:</label>
                            <input type="date" id="AN_fecha_inicio" name="AN_fecha_inicio"  onchange="calcularDiferencia()" value="<?php echo $reg->AN_fecha_inicio; ?>">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Fecha de Término:</label>
                  <input type="date" id="AN_fecha_termino" name="AN_fecha_termino" onchange="calcularDiferencia()" value="<?php echo $reg->AN_fecha_termino; ?>">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Días Restantes:</label>
                  <input type="number" id="AN_fecha_restante" name="AN_fecha_restante"  readonly>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <label >Día Actual:</label><br>            
              <div id="AN_progreso_dia" class="progress-bar"></div>
              <div id="dias-element-AN_progreso_dia" class="dias-element"></div>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Estado:</label>
                  <select class="form-control select-picker" name="AN_estado" id="AN_estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Proceso">Proceso</option>
                    <option value="Terminado">Terminado</option>
                  </select>
                </div>

                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <label>Comentario:</label>
    <textarea class="form-control textarea elegant-background" name="AN_comentario" id="AN_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->AN_comentario; ?></textarea>
</div>




                    <label>DISEÑO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                       <input type="date" id="DI_fecha_inicio" name="DI_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->DI_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="DI_fecha_termino" name="DI_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->DI_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="DI_fecha_restante" name="DI_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="DI_progreso_dia"></div>
                     
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="DI_estado" id="DI_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="DI_comentario" id="DI_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->DI_comentario; ?></textarea>
                    </div>
                    <label>DESARROLLO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="DE_fecha_inicio" name="DE_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->DE_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="DE_fecha_termino" name="DE_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->DE_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="DE_fecha_restante" name="DE_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="DE_progreso_dia">  </div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="DE_estado" id="DE_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="DE_comentario" id="DE_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->DE_comentario; ?></textarea>
                    </div>
                    <label>IMPLEMENTACIÓN</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="IM_fecha_inicio" name="IM_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->IM_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="IM_fecha_termino" name="IM_fecha_termino"onchange="calcularDiferencia()"value="<?php echo $reg->IM_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="IM_fecha_restante" name="IM_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="IM_progreso_dia"></div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="IM_estado" id="IM_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="IM_comentario" id="IM_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->IM_comentario; ?></textarea>
                    </div>
                    <label>MANTENIMIENTO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="MAN_fecha_inicio" name="MAN_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->MAN_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="MAN_fecha_termino" name="MAN_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->MAN_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="MAN_fecha_restante" name="MAN_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="MAN_progreso_dia">  </div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="MAN_estado" id="MAN_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="MAN_comentario" id="MAN_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->MAN_comentario; ?></textarea>
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
                             

                                
                            <!-- </form> -->

                            <div class='col-md-12' id="result"></div><!-- Carga los datos ajax -->

                         
                        
                        </div>
                        <div class="panel-footer text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-sm btn-success"  id="btnGuardar"><i class="fa fa-save"></i> Actualizar datos</button>
                                <button class="btn btn-sm btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> &nbsp;&nbsp; Regresar</button>
                          </div>

                      </form>
                        
                     </div>
        
                      

                     <!--Fin centro -->
                   </div><!-- /.box -->
               </div><!-- /.col -->
           </div><!-- /.row -->
       </section><!-- /.content -->

     </div>
    } else {
      <div class="content-wrapper">
           <!-- Main content -->
         <section class="content">
             <div class="row">
               <div class="col-md-12">
                   <div class="box box-primary">
                   <div class="box-header with-border">
               <h1 class="box-title"> Proceso de Desarrollo</h1>
                 <div class="box-tools pull-right">
                 </div>
               </div>
                     <!-- /.box-header -->
                     <!-- centro -->
                     <div class="panel-body table-responsive"  id="listadoregistros">
                      <form  id="formulario" name="formulario" enctype="multipart/form-data">
                      <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12">
              <label class="linea_p">NOMBRE DEL CLIENTE:</label>
           <br>
              <input type="text" id="nombre_cliente" readonly value="<?php echo $reg->nombre; ?>">
              </div>
              <input type="hidden" name="idproc_desarrollo" id="idproc_desarrollo" value="<?php echo $reg->idproc_desarrollo; ?>">
          
                      <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12" >
              <label class="linea_p">NOMBRE DEL PROYECTO:</label><br>
              <!-- <spam id="nombre_proyecto"><?php echo $reg->nombre_proyecto; ?></spam> -->
              <input type="text" name="nombre_proyecto" id="nombre_proyecto" readonly value="<?php echo $reg->nombre_proyecto; ?>">

              </div>
           
                     
                            <div class="col-lg-12">
                            <label>ANÁLISIS</label><br>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha de Inicio:</label>
                            <input type="date" id="AN_fecha_inicio" name="AN_fecha_inicio"  onchange="calcularDiferencia()" value="<?php echo $reg->AN_fecha_inicio; ?>">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Fecha de Término:</label>
                  <input type="date" id="AN_fecha_termino" name="AN_fecha_termino" onchange="calcularDiferencia()" value="<?php echo $reg->AN_fecha_termino; ?>">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Días Restantes:</label>
                  <input type="number" id="AN_fecha_restante" name="AN_fecha_restante"  readonly>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <label >Día Actual:</label><br>            
              <div id="AN_progreso_dia" class="progress-bar"></div>
              <div id="dias-element-AN_progreso_dia" class="dias-element"></div>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Estado:</label>
                  <select class="form-control select-picker" name="AN_estado" id="AN_estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Proceso">Proceso</option>
                    <option value="Terminado">Terminado</option>
                  </select>
                </div>

                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <label>Comentario:</label>
    <textarea class="form-control textarea elegant-background" name="AN_comentario" id="AN_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->AN_comentario; ?></textarea>
</div>




                    <label>DISEÑO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                       <input type="date" id="DI_fecha_inicio" name="DI_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->DI_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="DI_fecha_termino" name="DI_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->DI_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="DI_fecha_restante" name="DI_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="DI_progreso_dia"></div>
                     
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="DI_estado" id="DI_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="DI_comentario" id="DI_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->DI_comentario; ?></textarea>
                    </div>
                    <label>DESARROLLO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="DE_fecha_inicio" name="DE_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->DE_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="DE_fecha_termino" name="DE_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->DE_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="DE_fecha_restante" name="DE_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="DE_progreso_dia">  </div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="DE_estado" id="DE_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="DE_comentario" id="DE_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->DE_comentario; ?></textarea>
                    </div>
                    <label>IMPLEMENTACIÓN</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="IM_fecha_inicio" name="IM_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->IM_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="IM_fecha_termino" name="IM_fecha_termino"onchange="calcularDiferencia()"value="<?php echo $reg->IM_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="IM_fecha_restante" name="IM_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="IM_progreso_dia"></div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="IM_estado" id="IM_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="IM_comentario" id="IM_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->IM_comentario; ?></textarea>
                    </div>
                    <label>MANTENIMIENTO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="MAN_fecha_inicio" name="MAN_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->MAN_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="MAN_fecha_termino" name="MAN_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->MAN_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="MAN_fecha_restante" name="MAN_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="MAN_progreso_dia">  </div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="MAN_estado" id="MAN_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="MAN_comentario" id="MAN_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->MAN_comentario; ?></textarea>
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
                             

                                
                            <!-- </form> -->

                            <div class='col-md-12' id="result"></div><!-- Carga los datos ajax -->

                         
                        
                        </div>
                        <div class="panel-footer text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-sm btn-success"  id="btnGuardar"><i class="fa fa-save"></i> Actualizar datos</button>
                                <button class="btn btn-sm btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> &nbsp;&nbsp; Regresar</button>
                          </div>

                      </form>
                        
                     </div>
        
                      

                     <!--Fin centro -->
                   </div><!-- /.box -->
               </div><!-- /.col -->
           </div><!-- /.row -->
       </section><!-- /.content -->

     </div>
    }
    
    require_once "../modelos/proceso_desarrollo.php";
    $proceso= new Proceso_desarrollo();
    $rspta = $proceso->mostrar($_GET['id']);
    $reg = $rspta->fetch_object();
  
?>
<style type="text/css">
 .desarrollo {
  
  height: 100px;
  
}

#AN_progreso_dia,
#DI_progreso_dia,
#DE_progreso_dia,
#IM_progreso_dia,
#MAN_progreso_dia {
  position: relative;
  width: 100%;
  height: 38px;
  border-radius: 8px;
  background: #ccc;
  margin-bottom: 10px;

}
/*background: linear-gradient(to right, red 0%, red 33%, white 33%, white 66%, red 66%, red 100%);*/

#AN_progreso_dia:hover,
#DI_progreso_dia:hover,
#DE_progreso_dia:hover,
#IM_progreso_dia:hover,
#MAN_progreso_dia:hover {
  background: linear-gradient(to right, red 0%, red 33%, white 33%, white 66%, red 66%, red 100%);

}

.elegant-background {
  background-color: #f7f7f7;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  font-family: Arial, sans-serif;
  font-size: 14px;
  color: #333;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

input[type="date"],
input[type="text"],
input[type="number"],
select {
  width: 100%;
  padding: 8px;
  border: 1px solid black;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 16px;
}


.dias-element {
  position: absolute;
  top: 13px;
  font-size: 12px;
  display: flex;
}

.linea_p {
    display: inline-block;
    margin-right: 5px;
  }
  
  #orden_linea {
    display: inline-block;
  }
/* Estilos para la barra de progreso */

</style>
<!-- <link rel="stylesheet" type="text/css" href="style/loading.css"> -->

	<div class="content-wrapper">
    <!-- Content Header (Page header) -->


         <!-- Main content -->
         <section class="content">
             <div class="row">
               <div class="col-md-12">
                   <div class="box box-primary">
                   <div class="box-header with-border">
               <h1 class="box-title"> Proceso de Desarrollo</h1>
                 <div class="box-tools pull-right">
                 </div>
               </div>
                     <!-- /.box-header -->
                     <!-- centro -->
                     <div class="panel-body table-responsive"  id="listadoregistros">
                      <form  id="formulario" name="formulario" enctype="multipart/form-data">
                      <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12">
              <label class="linea_p">NOMBRE DEL CLIENTE:</label>
           <br>
              <input type="text" id="nombre_cliente" readonly value="<?php echo $reg->nombre; ?>">
              </div>
              <input type="hidden" name="idproc_desarrollo" id="idproc_desarrollo" value="<?php echo $reg->idproc_desarrollo; ?>">
          
                      <div class="form-group col-lg-6 col-md-2 col-sm-2 col-xs-12" >
              <label class="linea_p">NOMBRE DEL PROYECTO:</label><br>
              <!-- <spam id="nombre_proyecto"><?php echo $reg->nombre_proyecto; ?></spam> -->
              <input type="text" name="nombre_proyecto" id="nombre_proyecto" readonly value="<?php echo $reg->nombre_proyecto; ?>">

              </div>
           
                     
                            <div class="col-lg-12">
                            <label>ANÁLISIS</label><br>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fecha de Inicio:</label>
                            <input type="date" id="AN_fecha_inicio" name="AN_fecha_inicio"  onchange="calcularDiferencia()" value="<?php echo $reg->AN_fecha_inicio; ?>">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Fecha de Término:</label>
                  <input type="date" id="AN_fecha_termino" name="AN_fecha_termino" onchange="calcularDiferencia()" value="<?php echo $reg->AN_fecha_termino; ?>">
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Días Restantes:</label>
                  <input type="number" id="AN_fecha_restante" name="AN_fecha_restante"  readonly>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <label >Día Actual:</label><br>            
              <div id="AN_progreso_dia" class="progress-bar"></div>
              <div id="dias-element-AN_progreso_dia" class="dias-element"></div>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <label>Estado:</label>
                  <select class="form-control select-picker" name="AN_estado" id="AN_estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Proceso">Proceso</option>
                    <option value="Terminado">Terminado</option>
                  </select>
                </div>

                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <label>Comentario:</label>
    <textarea class="form-control textarea elegant-background" name="AN_comentario" id="AN_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->AN_comentario; ?></textarea>
</div>




                    <label>DISEÑO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                       <input type="date" id="DI_fecha_inicio" name="DI_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->DI_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="DI_fecha_termino" name="DI_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->DI_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="DI_fecha_restante" name="DI_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="DI_progreso_dia"></div>
                     
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="DI_estado" id="DI_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="DI_comentario" id="DI_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->DI_comentario; ?></textarea>
                    </div>
                    <label>DESARROLLO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="DE_fecha_inicio" name="DE_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->DE_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="DE_fecha_termino" name="DE_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->DE_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="DE_fecha_restante" name="DE_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="DE_progreso_dia">  </div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="DE_estado" id="DE_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="DE_comentario" id="DE_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->DE_comentario; ?></textarea>
                    </div>
                    <label>IMPLEMENTACIÓN</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="IM_fecha_inicio" name="IM_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->IM_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="IM_fecha_termino" name="IM_fecha_termino"onchange="calcularDiferencia()"value="<?php echo $reg->IM_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="IM_fecha_restante" name="IM_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="IM_progreso_dia"></div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="IM_estado" id="IM_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="IM_comentario" id="IM_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->IM_comentario; ?></textarea>
                    </div>
                    <label>MANTENIMIENTO</label><br>  
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                      <label>Fecha de Inicio: &nbsp; </label>
                      <input type="date" id="MAN_fecha_inicio" name="MAN_fecha_inicio" onchange="calcularDiferencia()" value="<?php echo $reg->MAN_fecha_inicio; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Fecha de Termino: &nbsp; </label>
                      <input type="date" id="MAN_fecha_termino" name="MAN_fecha_termino"onchange="calcularDiferencia()" value="<?php echo $reg->MAN_fecha_termino; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Dias Restante:&nbsp; </label>
                      <input type="number" id="MAN_fecha_restante" name="MAN_fecha_restante" readonly>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12" >
                      <label>Dia Actual:&nbsp;  </label>
                      <div id="MAN_progreso_dia">  </div>
                    </div>
                    <div  class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12 ">   
                    <label>Estado</label>     
                        <select class="form-control select-picker" name="MAN_estado" id="MAN_estado" required>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Proceso">Proceso</option>
                           <option value="Terminado">Terminado</option>
                        </select>
                    </div> 

                    
                     
                    <div class="form-group  col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <label>Comentario:</label>
                      <textarea type="text" class="form-control desarrollo" name="MAN_comentario" id="MAN_comentario" cols="40" rows="2" style="resize: none;"><?php echo $reg->MAN_comentario; ?></textarea>
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
                             

                                
                            <!-- </form> -->

                            <div class='col-md-12' id="result"></div><!-- Carga los datos ajax -->

                         
                        
                        </div>
                        <div class="panel-footer text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-sm btn-success"  id="btnGuardar"><i class="fa fa-save"></i> Actualizar datos</button>
                                <button class="btn btn-sm btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> &nbsp;&nbsp; Regresar</button>
                          </div>

                      </form>
                        
                     </div>
        
                      

                     <!--Fin centro -->
                   </div><!-- /.box -->
               </div><!-- /.col -->
           </div><!-- /.row -->
       </section><!-- /.content -->

     </div>

	

<?php
}else{
  require "noacceso.php";
}
	require_once('footer.php');

 ?>
<link rel="stylesheet" type="text/css" href="../public/css/ciclo.css">
 <script type="text/javascript" src="scripts/proceso_desarrollo.js"></script>
<?php 
  }
  ob_end_flush();
 ?>
