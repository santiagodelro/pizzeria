<?php 



function Insertar($email,$nombre,$apellido,$telefono,$domicilio,$fecha,$tipo,$conexion)
{
	$sql="INSERT INTO persona (nombre_persona,apellido,telefono,domicilio,fecha_nac,id_tipo,email) VALUES ('$nombre','$apellido','$telefono','$domicilio','$fecha','$tipo','$email') " ;

	$query=mysqli_query($conexion,$sql);
	if ($query) {
		return true;
	}
	return false;	
}


function ObtenerIdCategoria($descripcion,$conexion)
{	
	$sql="SELECT * FROM  tipo_persona WHERE descripcion='$descripcion' ";
	$query=mysqli_query($conexion,$sql);

	while ($array=mysqli_fetch_array($query)) {
		$id=$array['id_tipo'];
	}
	
	return $id;

}


function ObtenerIdPersona($conexion)
{
	$sql="SELECT MAX(id_persona) as id FROM persona ";
	$query=mysqli_query($conexion,$sql);

	while ($array=mysqli_fetch_array($query)) {
		$id=$array['id'];
	};
	
	return $id;
	
	
}


function Eliminar($tabla,$campo,$id,$conexion)
{
	$sql=" DELETE FROM $tabla WHERE $campo='$id' ";
	$query=mysqli_query($conexion,$sql);

	if (!$query) {
		return "fail";	
	}
	else{
		return "ok";

	}
}














?>