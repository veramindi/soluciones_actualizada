<?php

  ob_start();
  session_start();
  if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
  }else{

	//require_once("../config/conexion.php");
	require 'header.php';
	if ($_SESSION['configuracion'] == 1) {

	//$sqll="SELECT * FROM perfil where idperfil='1' ";
	//$quer=mysqli_query($conexion,$sqll);
	//$row=mysqli_fetch_array($quer);

	$sqll="SELECT * FROM igv where idIGV='1' ";
	$quer=mysqli_query($conexion,$sqll);
	$row=mysqli_fetch_array($quer);

?>
      <div class="content-wrapper">   <br>     
              <div class="col-md-12" id="valorIgv">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Cambiar IGV </h1>
                    </div>
                    <!-- <div class="panel-body"> -->
                      <form  method="post" id="idigv" enctype="multipart/form-data">
				              <div class="row">
				                <div class="col-md-3 col-lg-3 " align="center">
								<div id="load_img">
									<img name="logo" class="img-responsive" src="../files/perfil/logo.png" alt="Logo" width="300px" id="previsualizar">
									<!-- <img name="logo" class="img-responsive" src="../files/perfil/<?php echo $row['logo']; ?>" alt="Logo" width="300px" id="previsualizar"> -->
								</div>
								 </div> 
				                <div class=" col-md-9 col-lg-9 ">
				                  <table class="table table-condensed">
				                    <tbody>
				                      <tr>
				                        <td class='col-md-3'>Identificador IGV</td>
				                        <td><input type="text" class="form-control input-sm" id="idIGV" disabled></td>
				                      </tr>
				                      <!-- <tr> -->
				                        <td class='col-md-3'>Impuesto</td>
				                        <td><input type="text" class="form-control input-sm" name="porcentaje" id="porcentaje" value="<?php echo $row['porcentaje']; ?>" required></td>
				                      <!-- </tr> -->
			
				                    </tbody>
				                  </table>
					                	</div>
					              </div>
					                 <div class="panel-footer text-center">
                           <input type="submit" class="btn btn-sm btn-success" value="Actualizar" onclick="evitandoVacio(event)"> <br>
                              
					                <!-- <button type="submit" class="btn btn-sm btn-success" value="Actualizar" onclick="evitandoVacio(event)"> -->
				                    </div>
					        </div>
						</form>
						 <!--<form method="post" action="ejecutarScript.php">
                                    <input type="submit" name="ejecutar" value="Ejecutar Script">
                                </form>-->
                                <button><a href="cpanel.py">Descargar</a></button>
                </div>
                    </div>
                  </div>
          </div>
      <!-- </section> -->
    </div>
<?php
}
	require 'footer.php';
?>
<script type="text/javascript" src="scripts/igv.js"></script>

<?php 
  }
  ob_end_flush();
 ?>
