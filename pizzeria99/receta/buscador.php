<?php 
include '../conexion/conexion.php';

$buscador=$_GET['buscador'];


$conexion=conexion();

$query="SELECT * FROM producto WHERE nombre LIKE '$buscador%' or nombre='$buscador'"; 
$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'id_prod'=>$fila['id_prod'],
		'nombre'=>$fila['nombre']
		
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;













?>