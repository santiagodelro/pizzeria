<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$query="SELECT * FROM medida WHERE nombre_medida!='Caja' and nombre_medida!='Bolsa'"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {
	$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";
	echo $lista;	
}





















?>