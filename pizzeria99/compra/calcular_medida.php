<?php 

include '../conexion/conexion.php';
$medida=$_POST['medida'];
$conexion=conexion();
ObtenerOption($medida,$conexion);
$query="SELECT * FROM medida WHERE nombre_medida!='$medida'"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {
	
	$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";

	echo $lista;
	
}






function ObtenerOption($nombre,$conexion)
{
	$sql="SELECT *FROM medida WHERE nombre_medida='$nombre'";
	$query=mysqli_query($conexion,$sql);

	while ($fila=mysqli_fetch_array($query)) {
		$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";
		echo $lista;
	}
}














?>