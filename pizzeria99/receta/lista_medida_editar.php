<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$tipo=$_POST['idm'];
$query="SELECT * FROM medida WHERE id_medida!='$tipo'"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {

	$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";

	echo $lista;
	
}





















?>