<?php

include '../conexion/conexion.php';

$conexion=conexion();
$medida=$_POST['medida'];
$query="SELECT * FROM medida WHERE nombre_medida='$medida'"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {

	$lista= $fila['id_medida'];
	
}

echo $lista;



















?>