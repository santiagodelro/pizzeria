<?php 

function Validar_Categoria($nombre,$conexion)
{
	$sql="SELECT * FROM tipo_persona";
	$query=mysqli_query($conexion,$sql);

	while ($fila=mysqli_fetch_array($query)) {
		if ( strtolower($nombre)==strtolower($fila['descripcion'])) {
			return true;
		}	
	}
	return false;

}



?>