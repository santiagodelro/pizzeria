<?php 

function Validar_Categoria($nombre,$conexion)
{
	$sql="SELECT * FROM categoria";
	$query=mysqli_query($conexion,$sql);

	while ($fila=mysqli_fetch_array($query)) {
		if ( strtolower($nombre)==strtolower($fila['nombre_cat'])) {
			return true;
		}	
	}
	return false;

}



?>