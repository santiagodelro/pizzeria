<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$query="SELECT * FROM medida"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {
	
	$lista="<option value='$fila[nombre_medida]'>$fila[nombre_medida]</option>";

	echo $lista;
	
}





















?>