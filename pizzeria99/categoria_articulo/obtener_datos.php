<?php
include '../conexion/conexion.php';


$id=$_POST['id'];

$conexion=conexion();

$query="SELECT * FROM categoria where id_cat='$id'";

$resultado=mysqli_query($conexion,$query);

if(!$resultado){
	die('ERROR en la consulta');
}

$json=array();

while ($fila=mysqli_fetch_array($resultado)) {
	
	$json[]=array(
		'id_cat'=>$fila['id_cat'],
		'nombre_cat'=>$fila['nombre_cat']
	);
	
}

$jsonstring=json_encode($json[0]);
echo $jsonstring;

?>