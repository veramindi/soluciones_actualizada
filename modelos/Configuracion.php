<?php 

require_once "../config/Conexion.php";


class Configuracion{

	public function editar($razon_social,$nombre_comercial,$ruc,$direccion,$distrito,$provincia,$departamento,$codigo_postal,$telefono,$email,$web,$logo,$pais,$fecha_inicio,$direccion2,$rubro){
		$sql="UPDATE perfil SET razon_social='$razon_social', nombre_comercial='$nombre_comercial', ruc='$ruc', direccion='$direccion', distrito='$distrito', provincia='$provincia', departamento='$departamento', codigo_postal='$codigo_postal', telefono='$telefono',email='$email',web='$web',logo='$logo', pais='$pais', fecha_inicio='$fecha_inicio', direccion2='$direccion2', rubro='$rubro' where idperfil='1'";
		return ejecutarConsulta($sql);
	}

	public function mostrar(){
		$sql = "SELECT * FROM perfil WHERE idperfil='1'";
		return ejecutarConsulta($sql);
	}

}

 ?>
