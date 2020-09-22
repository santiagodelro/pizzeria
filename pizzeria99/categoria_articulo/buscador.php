<?php 
include '../conexion/conexion.php';

$buscador=$_POST['buscador'];


$conexion=conexion();

$query="SELECT *FROM categoria where nombre_cat LIKE '$buscador%' or  id_cat LIKE '$buscador%'"; 
$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'id_cat' =>$fila['id_cat'] ,
		'nombre_cat' =>$fila['nombre_cat']
		
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;













?>