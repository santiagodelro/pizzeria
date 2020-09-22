<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$id=$_POST['id'];
$query="SELECT * FROM producto WHERE id_prod='$id'"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {

	$lista="<option value='$fila[id_prod]' >$fila[nombre]</option>";
	echo $lista;
	
}





















?>